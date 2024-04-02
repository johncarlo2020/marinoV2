<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Shift;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Sales Chart';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Shift::class)
            ->dateColumn('date')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('sales');
     
        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
