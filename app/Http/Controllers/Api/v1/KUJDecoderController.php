<?php


namespace App\Http\Controllers\Api\v1;


use Cache;
use Illuminate\Http\Resources\Json\ResourceCollection;

class KUJDecoderController
{
    public function search(string $search = "")
    {
        return Cache::remember("kuj_search_$search", 60 * 60, function () use ($search) {
            return \Http::asForm()
                 ->post("http://web.okir.hu/licoms/dbb-mybatis/KARLOW01/MEGNEVEZES/$search/ORDER_BY/KUJ/DIR/ASC/", [
                     "start" => 0,
                     "limit" => 25,
                 ])->body();
        });
    }

    public function details(string $kujNumber = "")
    {
        return Cache::remember("kuj_details_$kujNumber", 60 * 60, function () use ($kujNumber) {
            return \Http::asForm()
                 ->post("http://web.okir.hu/licoms/dbb-popup/KARLOW01/KUJ/$kujNumber/QU/KUJ_KTJ/", [
                     "start" => 0,
                     "limit" => 25,
                 ])->body();
        });
    }
}
