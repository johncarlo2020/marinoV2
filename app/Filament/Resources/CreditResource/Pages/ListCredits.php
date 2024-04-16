<?php

namespace App\Filament\Resources\CreditResource\Pages;

use App\Filament\Resources\CreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListCredits extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = CreditResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CreditResource\Widgets\CreditOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }
}
