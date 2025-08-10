<div class="bg-gradient-to-b from-gray-50 to-gray-100 border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md" style="width: {{ $width }};">
    <canvas id="{{ $id }}" style="height: {{ $height }}; width: 200px"></canvas>
    @if ($datasets)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @php
                    $isHorizontal = in_array($type, ['bar_horizontal', 'bar_horizontal_stacked']);
                @endphp
        
                const config = {
                    type: '{{ $type === 'line' ? 'line' : 'bar' }}',
                    data: {
                        labels: @json($labels),
                        datasets: @json($datasets)
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        indexAxis: '{{ $isHorizontal ? 'y' : 'x' }}',
                        scales: {
                            {{ $isHorizontal ? 'x' : 'y' }}: {
                                beginAtZero: true,
                                stacked: false,
                                suggestedMax: Math.max(...@json(array_column($datasets, 'data'))) || 10, // Default to 10 if all values are 0
                                ticks: { stepSize: 10 }
                            }
                        },
                        plugins: {
                            legend: {
                                display: {{ $type === 'pie' ? 'true' : 'false' }},
                                position: 'right',
                                labels: {
                                    color: '#222',
                                    font: { size: 10 }
                                }
                            },
                            datalabels: {
                                formatter: (value) => {
                                    return value === 0 ? '' : value; // Do not display label if value is 0
                                },
                                anchor: '{{ $isHorizontal ? "left" : "end" }}',
                                align: '{{ $isHorizontal ? "center" : "top" }}',
                                color: '#000',
                                font: { size: 10 }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                };
        
                const ctx = document.getElementById(@json($id)).getContext('2d');
                new Chart(ctx, config);
            });
        </script>
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @php
                    $isHorizontal = ($type === 'bar_horizontal');
                @endphp

                const config = {
                    type: @json($isHorizontal ? 'bar' : $type),
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: @json($title),
                            data: @json($data),
                            backgroundColor: @json($colors),
                            borderWidth: 1,
                            @if ($type === 'pie')
                                hoverOffset: 6,
                            @endif
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        indexAxis: @if($isHorizontal) 'y' @else 'x' @endif,
                        scales: {
                            @if($isHorizontal)
                            x: {
                                beginAtZero: true,
                                suggestedMax: Math.max(...@json($data)) + 2,
                                ticks: { stepSize: 1 }
                            },
                            y: {
                                ticks: {
                                    autoSkip: false,
                                    font: { size: 10 }
                                }
                            }
                            @elseif($type == 'pie')
                            @else
                            y: {
                                beginAtZero: true,
                                suggestedMax: Math.max(...@json($data)) + {{ $type == 'line' ? 0 : 2 }},
                                ticks: { stepSize: 1 }
                            },
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    font: { size: 10 }
                                }
                            }
                            @endif
                        },
                        plugins: {
                            legend: 
                                @if ($type === 'pie')
                                {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        color: '#222',
                                        font: { size: 10 },
                                        boxWidth: 10,
                                        padding: 5
                                    }
                                }
                                @else
                                {
                                    display: false
                                }
                                @endif,
                            datalabels: 
                                @if ($type === 'pie')
                                {
                                    formatter: (value, context) => {
                                        if (value === 0) return '';
                                        const data = context.chart.data.datasets[0].data;
                                        const total = data.reduce((a, b) => a + b, 0);
                                        return ((value / total) * 100).toFixed(1) + '%';
                                    },
                                    color: '#fff',
                                    font: { size: 10 },
                                    anchor: 'center',
                                    align: 'center'
                                }
                                @else
                                {
                                    formatter: value => value === 0 ? '' : value,
                                    anchor: '{{ $isHorizontal ? "left" : "end" }}',
                                    align: '{{ $isHorizontal ? "right" : "top" }}',
                                    color: '#000',
                                    font: { size: 10 }
                                }
                                @endif
                        }
                    },
                    plugins: [ChartDataLabels]
                };

                const ctx = document.getElementById('{{ $id }}').getContext('2d');
                new Chart(ctx, config);
            });
        </script>
    @endif
</div>