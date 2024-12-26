<div class="card mt-3" id="stats-card-{{ $chartId = 'viewStatsChart_' . uniqid() }}">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <h3 class="card-title">{{ $title }} ({{ $chartData['period'] }})</h3>
        <div class="card-actions">
            @php
                $periods = [
                    'day' => 'Gün',
                    'week' => 'Hafta',
                    'month' => 'Ay',
                    'year' => 'Yıl',
                    'all' => 'Hepsi'
                ];
            @endphp

            <div class="btn-group">
                @foreach($periods as $period => $label)
                    <button type="button"
                       class="btn period-selector {{ $currentPeriod === $period ? 'btn-primary' : 'btn-secondary' }}"
                       onclick="window.statsChart_{{ $chartId }}.updatePeriod('{{ $period }}')"
                       data-period="{{ $period }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="{{ $chartId }}" width="400" height="200"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    class ViewStatsChart {
        constructor(chartId) {
            this.chartId = chartId;
            this.cardId = `stats-card-${chartId}`;
            this.chart = null;
            this.isUpdating = false;
            this.initChart(@json($chartData));
        }

        updatePeriod(period) {
            if (this.isUpdating) return;
            this.isUpdating = true;

            const params = new URLSearchParams(window.location.search);
            params.set('period', period);
            
            // AJAX isteğini JSON olarak yapalım
            fetch(`${window.location.pathname}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.chartData) throw new Error('Chart data not found in response');

                this.updateChart(data.chartData);
                
                // Butonların active durumunu güncelle
                document.querySelectorAll(`#${this.cardId} .period-selector`).forEach(btn => {
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-secondary');
                    if (btn.dataset.period === period) {
                        btn.classList.remove('btn-secondary');
                        btn.classList.add('btn-primary');
                    }
                });
                
                // URL'i güncelle
                window.history.pushState({}, '', `?${params.toString()}`);
            })
            .catch(error => {
                console.error('Error updating chart:', error);
            })
            .finally(() => {
                this.isUpdating = false;
            });
        }

        updateChart(chartData) {
            if (this.chart) {
                this.chart.destroy();
            }
            this.initChart(chartData);
        }

        initChart(chartData) {
            const canvas = document.getElementById(this.chartId);
            if (!canvas) {
                console.error('Canvas not found:', this.chartId);
                return;
            }

            const ctx = canvas.getContext('2d');
            if (!ctx) {
                console.error('Canvas context not found');
                return;
            }

            if (!chartData || chartData.labels.length === 0) {
                canvas.parentElement.innerHTML = '<div class="text-center text-muted py-4">Bu dönem için veri bulunamadı</div>';
                return;
            }

            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Görüntülenme Sayısı',
                        data: chartData.views,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }
    }

    // Global instance oluştur
    window.statsChart_{{ $chartId }} = new ViewStatsChart('{{ $chartId }}');
</script>
@endpush