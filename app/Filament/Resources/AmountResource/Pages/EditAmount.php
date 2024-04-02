<?php

namespace App\Filament\Resources\AmountResource\Pages;

use App\Filament\Resources\AmountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmount extends EditRecord
{
    protected static string $resource = AmountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
