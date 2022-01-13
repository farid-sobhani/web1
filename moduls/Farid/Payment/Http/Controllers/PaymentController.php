<?php

namespace Farid\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
use Farid\Common\Responses\AjaxResponses;
use Farid\Payment\Event\PaymentWasSuccessFull;
use Farid\Payment\Gateways\Gateway;
use Farid\Payment\Models\Payment;
use Farid\Payment\Repositories\PaymentRepo;

class PaymentController extends Controller
{
    public function index(PaymentRepo $paymentRepo , Request $request)
    {
        // todo security for each teacher and super admin
//        $this->authorize('index' , Payment::class);

        $totalSalesOf30LastDays = $paymentRepo->totalSalesOf30LastDays();
        $totalSiteNetIncome = $paymentRepo->totalSiteNetIncome();
        $totalSale = $paymentRepo->totalSale();
        $lastMonth = $paymentRepo->getLastMonth();
        $last30days = collect();

        $payments = Payment::query();


        if ($request->email) {
            // todo %like%
            $payments = $paymentRepo->searchEmail($request->email , $payments);
        }
        if ($request->invoice_id) {
            $payments = $paymentRepo->searchInvoiceId($request->invoice_id , $payments);
        }
        if ($request->name) {
            $payments = $paymentRepo->serachName($request->name , $payments);
        }
        $payments = $payments->get();

        while ($lastMonth < now()->subDay()) {
            $last30days->put(Jalalian::fromCarbon($lastMonth->addDay())->format('Y-m-d')
                ,[
                    'total' => $paymentRepo->getTotalPerDay($lastMonth)->sum('amount'),
                    'site_share' =>  $paymentRepo->getTotalPerDay($lastMonth)->sum('site_share'),
                    'seller_share' =>  $paymentRepo->getTotalPerDay($lastMonth)->sum('seller_share'),
                ]);
        }

        $totalNetIncome = $paymentRepo->totalNetIncome();
        return view('Payment::index', compact(
            'totalSalesOf30LastDays',
                  'totalSiteNetIncome',
                    'totalSale',
                    'totalNetIncome',
                    'last30days',
                    'payments'
        ));
    }

    public function callback(Request $request)
    {
        $gateway = resolve(Gateway::class);
        $payment = (new PaymentRepo())->findByAuthority($request->Authority);
        $paymentRepo = new PaymentRepo();
        if (!$payment) {
            return false;
        }
        $resault = $gateway->verify($payment->amount);
        if ($resault['status'] == 100) {
            $paymentRepo->changeStatus($payment->id, Payment::STATUS_SUCCESS);
            event(new PaymentWasSuccessFull($payment));
            AjaxResponses::SuccessResponse();

        } else {

            AjaxResponses::FailedResponse();

        }

        return redirect(route('courses.details', $payment->paymentable_id));
    }

    public function mypurchases()
    {
        $payments = auth()->user()->payments;
        return view('Payment::purchases',compact('payments'));
    }
}
