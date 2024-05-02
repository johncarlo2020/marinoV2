<?php

use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;

    function sendToToken($token , $data) {
    $url = "https://fcm.googleapis.com/fcm/send";
        $fields = array (
            'to'            => $token,
            'notification' => array(
                'title' => $data['title'],
                'body' => $data['body'],
                'icon' => "new",
                'sound' => "default",// Include image URL here
            ),
            'data' => $data['data'],
            'apns' => 
            array (
              'payload' => 
              array (
                'aps' => 
                array (
                  'contentAvailable' => true,
                ),
              ),
              'headers' => 
              array (
                'apns-push-type' => 'background',
                'apns-priority' => '5',
                'apns-topic' => 'io.flutter.plugins.firebase.messaging',
              ),
            ),
        );

        $header = array(
            "Authorization:key=AAAAQrgmlQ0:APA91bGRbqPSFje-DxFod5fRx486KyaThOcgOTC53hEVdIE_BfNprqQq1lQmv2KLzM4HyphJO2oWWatcT-RJWfnQOZwNt5oY1uX2j3Pqu0hfIgnScetzyjQ58og91xshWTbXfwc0V4tX",
            'Content-Type:application/json'
        );


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);

		if ($result === false)
        {
            return 0;
        }

        curl_close($ch);

        return 1;
    }

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
