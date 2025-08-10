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
        public string $width = '100%',
        public string $height = '350px',
        public array $datasets = [] // New property for multiple datasets
    ) {
        $this->width = $width;
        $this->height = $height;
        $this->config = match ($this->type) {
            'pie' => $this->buildPieChart(),
            'bar_horizontal' => $this->buildBarChart(true),
            'bar' => $this->buildBarChart(false),
            'bar_stacked' => $this->buildStackedBarChart(false),
            'bar_horizontal_stacked' => $this->buildStackedBarChart(true),
            'line' => $this->buildLineChart(), // Add line chart
            default => $this->buildBarChart(false),
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

    protected function buildBarChart(bool $horizontal = false): array
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
                'indexAxis' => $horizontal ? 'y' : 'x', // Set based on orientation
                'scales' => [
                    'x' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'stepSize' => 1,
                        ],
                    ],
                    'y' => [
                        'ticks' => [
                            'font' => ['size' => 10],
                        ],
                    ],
                ],
                'plugins' => [
                    'legend' => ['display' => false],
                ],
            ],
        ];
    }

    protected function buildStackedBarChart(bool $horizontal = false): array
    {
        return [
            'type' => 'bar',
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->datasets, // Use the datasets property for stacked bars
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'responsive' => true,
                'indexAxis' => $horizontal ? 'y' : 'x', // Set based on orientation
                'scales' => [
                    'x' => [
                        'beginAtZero' => true,
                        'stacked' => true, // Enable stacking
                        'ticks' => [
                            'stepSize' => 1,
                        ],
                    ],
                    'y' => [
                        'stacked' => true, // Enable stacking
                        'ticks' => [
                            'font' => ['size' => 10],
                        ],
                    ],
                ],
                'plugins' => [
                    'legend' => ['display' => true], // Show legend for stacked bars
                ],
            ],
        ];
    }
    
    protected function buildLineChart(): array
    {
        return [
            'type' => 'line',
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->datasets, // Use the datasets property for line charts
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'responsive' => true,
                'scales' => [
                    'x' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'font' => ['size' => 10],
                        ],
                    ],
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'font' => ['size' => 10],
                        ],
                    ],
                ],
                'plugins' => [
                    'legend' => ['display' => true],
                    'datalabels' => [
                        'anchor' => 'end',
                        'align' => 'end',
                        'color' => '#000',
                        'font' => ['size' => 10],
                    ],
                ],
            ],
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
            'datasets' => $this->datasets, // Pass datasets to the view
        ]);
    }
}