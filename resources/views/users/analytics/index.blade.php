@can('user-access')
    @extends('layouts.Users.Homeapp')
    @section('content')

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Anal</title>
            <!-- para analytics -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!--nav-->
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        </head>

        <body>
            <div class="container py-5">

                <h2 class="mb-4 text-primary">Record a Fish Catch</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form Card -->
                <div class="card shadow-sm mb-2 max-w-4xl mx-auto">
                    <div class="card-body">
                        <form action="{{ route('users.analytics.index') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fish_type" class="form-label">Fish Type</label>
                                    <input type="text" name="fish_type" id="fish_type" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Catch Location</label>
                                    <input type="text" name="location" id="location" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="caught_on" class="form-label">Date Caught</label>
                                    <input type="date" name="caught_on" id="caught_on" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="image">Save with image:</label>
                                    <input type="file" class="form-control-file" name="image" accept="image/*" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Save Catch</button>
                        </form>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <form method="GET" action="{{ route('users.analytics.index') }}" class="row g-3">
                            <div class="col-md-4">
                                <label for="filter_location" class="form-label">Filter by Location</label>
                                <input type="text" name="location" id="filter_location" class="form-control"
                                    placeholder="e.g. Cebu" value="{{ request('location') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- Chart Section -->
                <h3 class="text-center my-2 text-muted text-sm">Catch Distribution by Fish Type</h3>

                <div class="card mb-2 shadow-sm transition-transform hover:translate-y-1 hover:shadow-lg"
                    style="max-width: 600px; margin: 0 auto; flex justify-center">
                    <div class="card-body">
                        <canvas id="catchChart" height="180"></canvas>
                    </div>
                </div>

                <!-- Table Section -->
                <h4 class="text-secondary mb-3">Catch Analytics Table</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Fish Type</th>
                                <th>Quantity</th>
                                <th>Location</th>
                                <th>Date Caught</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catches as $catch)
                                <tr>
                                    <td>{{ $catch->fish_type }}</td>
                                    <td>{{ $catch->quantity }}</td>
                                    <td>{{ $catch->location }}</td>
                                    <td>{{ $catch->caught_on }}</td>
                                    <td>
                                        <div class="flex items-center justify-between space-x-4">
                                            @if($catch->image)
                                                <img src="{{ asset('storage/' . $catch->image) }}" alt="{{ $catch->fish_type }}"
                                                    class="h-24 w-auto rounded shadow" />
                                            @else
                                                <img src="https://via.placeholder.com/150x100?text=No+Image" alt="No Image"
                                                    class="h-24 w-auto rounded shadow" />
                                            @endif

                                            <a href="{{ asset('storage/' . $catch->image) }}" target="_blank"
                                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded shadow">
                                                View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $catches->links() }}

            </div>




            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctx = document.getElementById('catchChart').getContext('2d');

                // Prepare chart data safely
                const labels = @json($chartData->pluck('fish_type'));
                const quantities = @json($chartData->pluck('total_quantity'));

                if (labels.length > 0 && quantities.length > 0) {
                    const catchChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Quantity',
                                data: quantities,
                                backgroundColor: [
                                    '#42a5f5', '#66bb6a', '#ffa726', '#ab47bc', '#ec407a', '#26c6da', '#ef5350'
                                ],
                                borderColor: '#fff',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let value = context.parsed;
                                            let label = context.label;
                                            return `${label}: ${value} pcs`;
                                        }
                                    }
                                },
                                legend: { position: 'bottom' },
                                title: {
                                    display: true,
                                    text: 'Fish Caught Breakdown',
                                    font: { size: 18 }
                                }
                            },
                            animation: {
                                animateRotate: true,
                                animateScale: true
                            }
                        }
                    });
                } else {
                    // Optionally show a message if no data available
                    ctx.font = '16px Arial';
                    ctx.fillText('No data available to display chart.', 10, 50);
                }
            </script>
        </body>

        </html>







    @endsection
@endcan