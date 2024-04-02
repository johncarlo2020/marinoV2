<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Shift;
use Illuminate\Support\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
class ShiftChart extends ApexChartWidget
{
    protected int | string | array $columnSpan = 'full';
 
    // protected static string $chartId = 'tasksChart';
    protected static ?int $sort = 4;

 
    protected static ?string $heading = 'Sales Chart Daily';
 
    protected function getOptions(): array
    {
        $data = Trend::model(Shift::class) 
            ->dateColumn('date')
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->sum('sales'); 
 
        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Sales Chart Daily',
                    'data' => [7, 4, 6, 10, 14, 7, 5, 9, 10, 15, 13, 18], 
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate), 
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 
                'categories' => $data->map(fn (TrendValue $value) => $value->date), 
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#6366f1'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
