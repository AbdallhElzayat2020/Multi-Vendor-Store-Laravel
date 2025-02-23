<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected string $apiKey;
    protected $baseuel = 'https://api.currencyapi.com/v3/latest/';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert(float $amount, string $from, string $to): float
    {
        Http::baseUrl($this->baseuel)
            ->get();
//            ->withHeaders([
//                'content-type' => 'application/json',
//                'Authorization' => 'Bearer ' . $this->apiKey,
//                'Accept' => 'application/json',
//            ]);
    }
//    "cur_live_QZ1S4G33oQp8BcMMWLHe5tDw8h81oyvUQINJRXtN";
}
