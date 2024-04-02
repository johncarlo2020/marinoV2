<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Credit;
class CreditChart extends ChartWidget
{

    protected static ?string $heading = 'Credit Chart';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Trend::model(Credit::class)
            ->dateColumn('created_at')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount');
     
        return [
            'datasets' => [
                [
                    'label' => 'Credit Amount',
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
