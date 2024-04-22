<?php

namespace App\Filament\Resources\MopResource\Pages;

use App\Filament\Resources\MopResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMop extends EditRecord
{
    protected static string $resource = MopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
