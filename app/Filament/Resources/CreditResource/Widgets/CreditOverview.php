<?php

namespace App\Filament\Resources\CreditResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Filament\Resources\CreditResource\Pages\ListCredits;
class CreditOverview extends BaseWidget
{
    use InteractsWithPageTable;
    protected function getTablePage(): string
    {
        return ListCredits::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Credit', $this->getPageTableQuery()->sum('amount')),
        ];
    }
}
