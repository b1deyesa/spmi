<div class="bg-gradient-to-b from-gray-50 to-gray-100 border border-gray-300 shadow-lg shadow-gray-500/10 p-4 rounded-md" style="width: {{ $width }}">
    <canvas id="{{ $id }}" style="max-height: 220px;"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const config = {
                type: @json($type),
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
                    responsive: true,
                    @if ($type !== 'pie')
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: Math.max(...@json($data)) + 10,
                                ticks: { stepSize: 1 }
                            },
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    font: { size: 10 }
                                }
                            }
                        },
                    @endif
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
                                anchor: 'end',
                                align: 'top',
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
</div>
