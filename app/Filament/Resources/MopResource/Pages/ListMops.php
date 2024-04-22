<?php

namespace App\Filament\Resources\MopResource\Pages;

use App\Filament\Resources\MopResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMops extends ListRecords
{
    protected static string $resource = MopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
