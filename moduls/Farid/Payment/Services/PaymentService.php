<?php


namespace Farid\Payment\Services;


use Farid\Payment\Gateways\Gateway;
use Farid\Payment\Models\Payment;
use Farid\Payment\Repositories\PaymentRepo;
use Farid\User\Models\User;

class PaymentService
{
    public static function generate($amount , $product , User $buyer)
    {

        $paymentRepo = new PaymentRepo();

        $gateway = resolve(Gateway::class);
        $invoiceId = $gateway->request($amount,'/');
//        dd('stop',$invoiceId);
        $seller_p = $product->percent;
        $seller_share = $amount * $seller_p/100;
        $site_share = $amount - $seller_share;

        $paymentRepo->store([
            "buyer_id" => $buyer->id,
            "paymentable_id" => $product->id,
            "paymentable_type" => get_class($product),
            "amount" => $amount,
            "invoice_id" => $invoiceId,
            "gateway" => $gateway->getName(),
            "status" => Payment::STATUS_PENDING,
            "seller_p" => $seller_p,
            "seller_share" => $seller_share,
            "site_share" => $site_share,
        ]);
        return $invoiceId;
    }

}
