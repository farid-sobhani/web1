<?php
namespace Farid\Payment\Repositories;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use phpDocumentor\Reflection\Types\Integer;
use Farid\Course\Models\Course;
use Farid\Course\Repositories\CourseRepo;
use Farid\Payment\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class PaymentRepo
{
    public function store($data)
    {

        return Payment::create([
            "buyer_id" => $data['buyer_id'],
            "paymentable_id" => $data['paymentable_id'],
            "paymentable_type" => $data['paymentable_type'],
            "amount" => $data['amount'],
            "invoice_id" => $data['invoice_id'],
            "gateway" => $data['gateway'],
            "status" => $data['status'],
            "seller_p" => $data['seller_p'],
            "seller_share" => round($data['seller_share']),
            "site_share" => round($data['site_share']),
        ]);
    }

    public function findByAuthority($invoiceId)
    {
        return Payment::where('invoice_id',$invoiceId)->first();
    }

    public function findById($id)
    {
        return Payment::find($id);
    }

    public function changeStatus($id, $status)
    {
        $payment = $this->findById($id);
        return $payment->update([
           'status' => $status
        ]);
    }

    public function totalSalesOf30LastDays()
    {

        return $this->getLast30DayIncom()->sum('amount');
    }

    public function totalSiteNetIncome()
    {
        return $this->getLast30DayIncom()->sum('site_share');
    }

    public function totalSale()
    {
        return $this->getTotalSale()->sum('amount');
    }

    public function totalNetIncome()
    {
        return $this->getTotalSale()->sum('site_share');
    }

    public function getLast30DayIncom()
    {
        $date = $this->getLastMonth();
        return $this->getTotalSale()->where('created_at','>=',$date);
    }

    public function getTotalSale()
    {
        return Payment::where('status', 'success');
    }


    public function getLastMonth()
    {
        return \Carbon\Carbon::today()->subMonth();
    }

    public function getTotalPerDay($date)
    {
        return Payment::whereDate('created_at' , $date );
    }

    public function getAll()
    {
        return Payment::all();
    }

    public function searchEmail($email, $payments)
    {
        return $payments->join('users','users.id','buyer_id')->where('email',$email);
    }

    public function searchInvoiceId($invoice_id,$payments)
    {
        return $payments->where('invoice_id' , $invoice_id);
    }

    public function serachName($name, $payments)
    {
        return $payments->where('name' , $name);
    }


    public function getUserSuccessPayments($userId)
    {
        return Payment::where("seller_id", $userId)->where("status", Payment::STATUS_SUCCESS);;
    }
    public function getUserTotalSuccessAmount($userId)
    {
        return   $this->getUserSuccessPayments($userId)->sum("amount");
    }

    public function getUserTotalBenefit($userId)
    {
        return   $this->getUserSuccessPayments($userId)->sum("seller_share");
    }

    public function getUserTotalSellByDay($userId, $date)
    {
        return $this->getUserSuccessPayments($userId)->whereDate("created_at", $date)->sum("amount");
    }

    public function getUserSellCountByDay($userId, $date)
    {
        return $this->getUserSuccessPayments($userId)->whereDate("created_at", $date)->count();
    }
    public function getUserTotalBenefitByDay($userId, $date)
    {
        return  $this->getUserSuccessPayments($userId)->whereDate("created_at", $date)
            ->sum("seller_share");
    }


    public function getUserTotalBenefitByPeriod($userId, $startDate, $endDate)
    {
        return  Payment::where("seller_id", $userId)
            ->where("status",  Payment::STATUS_SUCCESS)
            ->whereDate("created_at",  "<= ",$startDate)
            ->whereDate("created_at" , ">=", $endDate)
            ->sum("seller_share");
    }

    public function getUserTotalSiteShare($userId)
    {
        return   $this->getUserSuccessPayments($userId)->sum("site_share");
    }
    public function paymentsBySellerId($id)
    {
        return Payment::query()->where("seller_id", $id);
    }
    public function getLastNDaysTotal($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("amount");
    }
    public function getLastNDaysSuccessPayments($days = null)
    {
        return $this->getLastNDaysPayments(Payment::STATUS_SUCCESS, $days);
    }
    public function getLastNDaysPayments($status, $days = null)
    {
        $query = Payment::query();

        if (!is_null($days)) $query = $query->where("created_at", ">=", now()->addDays($days));

        return $query->where("status", $status)->latest();
    }
    public function getLastNDaysSellerShare($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("seller_share");
    }
    public function getDailySummery(Collection $dates, $seller_id = null)
    {
        $query =  Payment::query()->where("created_at", ">=", $dates->keys()->first())
            ->groupBy("date")
            ->orderBy("date");

        if (!is_null($seller_id))
            $query->where("seller_id", $seller_id);

        return $query->get([
            DB::raw("DATE(created_at) as date"),
            DB::raw("SUM(amount) as totalAmount"),
            DB::raw("SUM(seller_share) as totalSellerShare"),
            DB::raw("SUM(site_share) as totalSiteShare"),
        ]);
    }


    public function increaseTeacherBalance($courseId , $sellerShare)
    {
        $course = resolve(CourseRepo::class)->findById($courseId);
        $teacher = $course->teacher;
    }


}
