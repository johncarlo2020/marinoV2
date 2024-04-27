<?php

use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;

function load($number,$baht,$network)
{
    $client = new Client();
    $authorizationToken = env('API_KEY');
    try {
        $response = $client->post('https://thailandtopup.com/api/v2/topup', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($authorizationToken . ':'),
                'Accept' => 'application/json', 
            ],
            'form_params' => [
                'number' => $number,
                'amount' => $baht,
                'network' => $network,
            ],
        ]);

        if ($response->getStatusCode() === 201) {
            $responseData = json_decode($response->getBody(), true);
            return $responseData;

        } else {
           
        }
    } catch (RequestException $e) {
        return $e;
    }
}

function loadPackage($number,$code)
{
    $client = new Client();
    $authorizationToken = env('API_KEY');
    try {
        $response = $client->post('https://thailandtopup.com/api/v2/topupais-pro', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($authorizationToken . ':'),
                'Accept' => 'application/json', 
            ],
            'form_params' => [
                'number' => $number,
                'code' => $code,
            ],
        ]);

        if ($response->getStatusCode() === 201) {
            $responseData = json_decode($response->getBody(), true);
            return $responseData;

        } else {
           
        }
    } catch (RequestException $e) {
        return $e;
    }
}
