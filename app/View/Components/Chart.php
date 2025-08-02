<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chart extends Component
{
    public array $config = [];

    public function __construct(
        public string $type = 'bar',
        public string $id = 'chart',
        public array $labels = [],
        public array $data = [],
        public array $colors = [],
        public string $title = 'Jumlah',
        public string $width = '100%'
    ) {
        $this->width = $width;
        
        $this->config = match ($this->type) {
            'pie' => $this->buildPieChart(),
            'bar' => $this->buildBarChart(),
            default => $this->buildBarChart(),
        };
    }

    protected function buildPieChart(): array
    {
        return [
            'type' => 'pie',
            'data' => [
                'labels' => $this->labels,
                'datasets' => [[
                    'label' => $this->title,
                    'data' => $this->data,
                    'backgroundColor' => $this->colors,
                    'borderWidth' => 1,
                    'hoverOffset' => 6,
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => true,
                        'position' => 'right',
                        'labels' => [
                            'color' => '#222',
                            'font' => ['size' => 10],
                            'boxWidth' => 10,
                            'padding' => 5,
                        ]
                    ]
                ]
            ]
        ];
    }

    protected function buildBarChart(): array
    {
        return [
            'type' => 'bar',
            'data' => [
                'labels' => $this->labels,
                'datasets' => [[
                    'label' => $this->title,
                    'data' => $this->data,
                    'backgroundColor' => $this->colors,
                    'borderWidth' => 1,
                ]]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'responsive' => true,
                'scales' => [
                    'x' => [
                        'ticks' => [
                            'autoSkip' => false,
                            'font' => ['size' => 10],
                        ]
                    ],
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => ['stepSize' => 1],
                    ]
                ],
                'plugins' => [
                    'legend' => ['display' => false]
                ]
            ]
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.chart', [
            'type' => $this->type,
            'id' => $this->id,
            'labels' => $this->labels,
            'data' => $this->data,
            'colors' => $this->colors,
            'title' => $this->title,
        ]);
    }
}