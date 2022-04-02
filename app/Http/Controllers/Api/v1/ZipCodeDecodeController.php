<?php


namespace App\Http\Controllers\Api\v1;


class ZipCodeDecodeController
{
    public function decode($zipcode)
    {
        return \Http::get("https://www.posta.hu/szolgaltatasok/posta-srv-zipcodefinder/rest/zipcode/telepulesKereso?zip={$zipcode}");
    }
}
