<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <select wire:model="selectedUser">
        <option value="">Tous les utilisateurs</option>
        @foreach ($this->users as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    </select>

    <canvas id="evaluationChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('evaluationChart').getContext('2d');
            let chart;

            function renderChart(data) {
                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.labels,
                        datasets: data.datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2);
                                    }
                                }
                            }
                        }
                    }
                });
            }

            Livewire.on('updateChartData', function (data) {
                renderChart(data);
            });

            renderChart(@json($evaluationData));
        });
    </script>
</div>
