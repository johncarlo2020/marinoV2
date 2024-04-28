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
            if(isset($responseData['error'])) {
                return $responseData;
            }
            $status = $responseData['status'];
            while($status == 'PENDING'){
                try {
                 $check = checkStatus($responseData['order_id']);
                 $status = $check['status'];

                 if($status !=='PENDING')
                 {
                    return $check;
                 }

                } catch (RequestException $e) {
                    return $e;
                }
                sleep(1);
            }
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
            if(isset($responseData['error'])) {
                return $responseData;
            }
            $status = $responseData['status'];
            while($status == 'PENDING'){
                try {
                 $check = checkStatus($responseData['order_id']);
                 $status = $check['status'];

                 if($status !=='PENDING')
                 {
                    return $check;
                 }

                } catch (RequestException $e) {
                    return $e;
                }
                sleep(1);
            }

        } else {
           
        }
    } catch (RequestException $e) {
        return $e;
    }
}

function checkStatus($order_id)
{
    $client = new Client();
    $authorizationToken = env('API_KEY');
    try {
        $response = $client->post('https://thailandtopup.com/api/v2/topupstatus', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($authorizationToken . ':'),
                'Accept' => 'application/json', 
            ],
            'form_params' => [
                'order_id' => $order_id,
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
