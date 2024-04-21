<?php

namespace App\Filament\Resources\StockResource\Pages;

use App\Filament\Resources\StockResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Item;

class CreateStock extends CreateRecord
{
    protected static string $resource = StockResource::class;

    protected function afterCreate(): void
    {
        $recipient = auth()->user();
 
Notification::make()
    ->title('Saved successfully')
    ->sendToDatabase($recipient);
    
        $data=$this->record();

        $item = Item::find($data->item_id);
        $item->qty = $item->qty + $data->qty;
        $item->save();
        // Runs after the form fields are saved to the database.
    }
}
