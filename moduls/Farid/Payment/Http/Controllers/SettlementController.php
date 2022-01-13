<?php


namespace Farid\Payment\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Farid\Common\Responses\AjaxResponses;
use Farid\Payment\Repositories\SettlementRepo;

class SettlementController extends Controller
{
    public function index(SettlementRepo $settlementRepo){

        $allSettlements = $settlementRepo->all();

        return view('Payment::settlement.index',compact('allSettlements'));
    }
    public function create()
    {
        return view('Payment::settlement.create');
    }

    public function store(SettlementRepo $settlementRepo)
    {

        if ($settlementRepo->checkUserPendingRequests()) {

            return back()->with('err','شما یک درخواست در حال انتظار دارید!');
        }
        $settlementRepo->store(auth()->user()->balance);
        $settlementRepo->resetToZero();
        return back()->with('success','درخواست تسویه حساب شما ثبت شد منتظر تایید از طرف مدیریت بمانید.باتشکر');

    }

    public function accept(Request $request , SettlementRepo $settlementRepo)
    {
        // todo transaction_id
        $settlementRepo->accept($request->id,1111111111111);

    }

}
