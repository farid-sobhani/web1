<?php

namespace Farid\Payment\Gateways\Zarinpal;

use Farid\Payment\Contracts\PaymentContract;

class ZarinpalAdaptor implements PaymentContract
{
    private $zp;
    private $url;
    public function request($Amount, $CallbackURL)
    {
        $CallbackURL = route("payments.callback");
        $this->zp = new Zarinpal();

        $result = $this->zp->request("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $Amount, 'توضیحات تراکنش', '', '', $CallbackURL, true, false);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            $this->url = $result['StartPay'];
            return $result["Authority"];

        } else {

            echo "خطا در ایجاد تراکنش";
            echo "<br />کد خطا : " . $result["Status"];
            echo "<br />تفسیر و علت خطا : " . $result["Message"];
        }
    }

    public function verify($Amount)
    {

        $zp = new zarinpal();
        $result = $zp->verify("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $Amount, true, false);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            return [
            "status" => $result["Status"],
            "RefID" => $result["RefID"]
        ];
        } else {

            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
    }

    public function redirect($invoiceId)
    {
        return $this->zp->redirect($this->url);
    }
    public function getName()
    {
        return "zarinpal";
    }

}
