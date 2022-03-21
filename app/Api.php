<?php

namespace Covid_Statistics_Bot\App;

require_once __DIR__.'/../vendor/autoload.php';
class Api
{

    private $curl;
    private array $responses;
    private string $countryName;

    public function __construct($countryName)
    {
        $this->countryName = $countryName;
        $this->curl = curl_init();
    }


    //return statistics if there is a statistics available for the given country or return false
    public function getStat()
    {
        curl_setopt_array($this->curl, [
            CURLOPT_URL => "https://covid-193.p.rapidapi.com/statistics",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: covid-193.p.rapidapi.com",
                "x-rapidapi-key: "
            ],
        ]);
        $response = curl_exec($this->curl);
        $err = curl_error($this->curl);

        curl_close($this->curl);
        if ($err) {
            return null;
        }
        $statistics = json_decode($response, true);
        $this->responses = $statistics["response"];
        return $this->getResponse();
    }

    //return response if there is a statistics available for the given country or return null
    private function getResponse()
    {
        $stat = null;
        foreach ($this->responses as $response) {
            if ($response['country'] == ucfirst($this->countryName)) {
                $stat = $response;
            }
        }
        return $stat;
    }
}
