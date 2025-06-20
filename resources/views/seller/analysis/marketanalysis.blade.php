@extends('layouts.Seller.Sellerapp')

@section('content')



    <div class="container my-5">
        <h2 class="text-center fw-bold mb-4">Market Analysis Dashboard</h2>


        <div class="col-md-12 mt-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 text-center Daily-Earnings-Chart">
                <div class="card-body py-5">
                    <div class="mb-3">
                        <i class="fas fa-calendar-day fa-3x text-warning"></i>
                    </div>
                    <h5 class="card-title fw-bold">Daily Earnings</h5>
                    <p class="text-muted small">Your earnings from each day.</p>
                    <canvas id="dailyEarningsChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Seller Earnings Chart -->
        <div class="col-md-12"> <!-- One full-width column -->
            <div class="card h-100 border-0 shadow-sm rounded-3 text-center Earnings-Chart">
                <div class="card-body py-5">
                    <!-- Chart Icon -->
                    <div class="mb-3">
                        <i class="fas fa-chart-line fa-3x text-success"></i> <!-- Fancy chart icon -->
                    </div>

                    <!-- Title -->
                    <h5 class="card-title fw-bold">Monthly Earnings</h5>

                    <!-- Small description -->
                    <p class="text-muted small">Your total earnings from completed orders each month.</p>

                    <!-- Chart container -->
                    <canvas id="earningsChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>







        <div class="row mt-5">
            {{-- Supply vs Demand --}}
            <div class="col-12 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Supply vs Demand</h5>
                        <canvas id="supplyDemandChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- Top-Selling Products --}}
            <div class="col-12 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Top-Selling Products</h5>
                        <canvas id="topSellingChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- Profit & Cost Comparison --}}
            <div class="col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Profit & Cost Comparison</h5>
                        <canvas id="profitCostChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            window.onload = function () {
                // Prepare PHP data
                const structuredDailyData = @json($dailyData ?? []);
                const dailyLabels = structuredDailyData.map(item => item.label);
                const dailyData = structuredDailyData.map(item => item.total);

                const structuredMonthlyData = @json($monthlyData ?? []);
                const monthlyLabels = structuredMonthlyData.map(item => item.label);
                const monthlyData = structuredMonthlyData.map(item => item.total);

                const supplyDemandData = @json($supplyDemand ?? []);
                const topSellingData = @json($topSelling ?? []);
                const profitCostData = @json($profitCostData ?? []);

                // === DAILY Earnings Chart ===
                const ctxDaily = document.getElementById('dailyEarningsChart').getContext('2d');
                new Chart(ctxDaily, {
                    type: 'line',
                    data: {
                        labels: dailyLabels,
                        datasets: [{
                            label: 'Daily Earnings (₱)',
                            data: dailyData,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: ctx => '₱' + ctx.parsed.y.toLocaleString()
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: val => '₱' + val.toLocaleString()
                                }
                            }
                        }
                    }
                });

                // === MONTHLY Earnings Chart ===
                const ctxMonthly = document.getElementById('earningsChart').getContext('2d');
                new Chart(ctxMonthly, {
                    type: 'line',
                    data: {
                        labels: monthlyLabels,
                        datasets: [{
                            label: 'Monthly Earnings (₱)',
                            data: monthlyData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            pointRadius: 4,
                            pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: ctx => '₱' + ctx.parsed.y.toLocaleString()
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: val => '₱' + val.toLocaleString()
                                }
                            }
                        }
                    }
                });

                // === SUPPLY vs DEMAND Chart ===
                const sdLabels = Object.keys(supplyDemandData);
                const supply = sdLabels.map(p => supplyDemandData[p].supply);
                const demand = sdLabels.map(p => supplyDemandData[p].demand);

                new Chart(document.getElementById('supplyDemandChart'), {
                    type: 'bar',
                    data: {
                        labels: sdLabels,
                        datasets: [
                            {
                                label: 'Supply',
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                data: supply
                            },
                            {
                                label: 'Demand',
                                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                                data: demand
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' }
                        }
                    }
                });

                // ✅ Convert object to array using Object.values
                const topArray = Object.values(topSellingData);
                

                const topLabels = topArray.map(item => item.product?.title || 'Untitled');
                const topValues = topArray.map(item => item.total_sold);

                new Chart(document.getElementById('topSellingChart'), {
                    type: 'bar',
                    data: {
                        labels: topLabels,
                        datasets: [{
                            label: 'Total Sold',
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                            data: topValues
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } }
                    }
                });

                // === PROFIT & COST Chart ===
                const pcLabels = Object.keys(profitCostData);
                const cost = pcLabels.map(p => profitCostData[p].cost);
                const revenue = pcLabels.map(p => profitCostData[p].revenue);
                const profit = pcLabels.map(p => profitCostData[p].profit);

                new Chart(document.getElementById('profitCostChart'), {
                    type: 'bar',
                    data: {
                        labels: pcLabels,
                        datasets: [
                            {
                                label: 'Cost',
                                backgroundColor: 'rgba(255, 159, 64, 0.7)',
                                data: cost
                            },
                            {
                                label: 'Revenue',
                                backgroundColor: 'rgba(153, 102, 255, 0.7)',
                                data: revenue
                            },
                            {
                                label: 'Profit',
                                backgroundColor: 'rgba(75, 192, 75, 0.7)',
                                data: profit
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' }
                        }
                    }
                });
            };
        </script>
    @endsection


@endsection