<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Credit;
use App\Models\Shift;


class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 1;
    protected function getCards(): array
    {
        $client = new Client();
            $authorizationToken = env('API_KEY');
            try {
                $response = $client->get('https://thailandtopup.com/api/v2/accountbalance', [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($authorizationToken . ':'),
                        'Accept' => 'application/json', 
                    ],
                ]);

                if ($response->getStatusCode() === 200) {
                    $responseData = json_decode($response->getBody(), true);
                    $cardData = $responseData['balance']; 
                  
                } else {

                }
            } catch (RequestException $e) {
                
            }
            $formattedAmount = number_format($cardData, 0, '.', ',') . ' BHT';

            $credit = Credit::sum('amount');
            $formattedCredit = number_format($credit, 0, '.', ',') ;

            $sales = Shift::sum('sales');
            $formattedSales = number_format($sales, 0, '.', ',') ;

             // Create and return the card
             return [
                Card::make('Balance', $formattedAmount),
                Card::make('Sales', $formattedSales),
                Card::make('Credit', $formattedCredit),

            ];
    }
}
