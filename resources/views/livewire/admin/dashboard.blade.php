<div class="p-6 sm:p-10">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 drop-shadow-md">
            Dashboard Admin
        </h1>
        <p class="text-gray-400 mt-1">Selamat datang kembali, {{ Auth::user()->name }}</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Films --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Total Films</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalFilms }}</p>
                </div>
                <div class="bg-amber-500/10 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Bookings --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Total Bookings</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalBookings }}</p>
                </div>
                <div class="bg-blue-500/10 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Total Revenue</p>
                    <p class="text-3xl font-bold text-white mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="bg-green-500/10 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Active Shows --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Active Shows</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $activeShows }}</p>
                </div>
                <div class="bg-purple-500/10 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Sales Chart --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Laporan Keuangan (Per-bulan)</h3>
            <div id="sales-chart"></div>
        </div>

        {{-- Bookings Chart --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Grafik Pembelian (Per-bulan)</h3>
            <div id="bookings-chart"></div>
        </div>
    </div>

    {{-- Now Showing & Coming Soon --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Now Showing --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Now Showing</h3>
            <div class="space-y-4">
                @forelse($nowShowingFilms as $film)
                    <div class="flex items-center space-x-4 p-3 bg-slate-700/50 rounded-lg hover:bg-slate-700 transition-colors">
                        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                             alt="{{ $film->title }}" 
                             class="w-16 h-24 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-semibold text-white">{{ $film->title }}</h4>
                            <p class="text-sm text-gray-400">{{ $film->genres->pluck('name')->join(', ') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No films currently showing</p>
                @endforelse
            </div>
        </div>

        {{-- Coming Soon --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Coming Soon</h3>
            <div class="space-y-4">
                @forelse($comingSoonFilms as $film)
                    <div class="flex items-center space-x-4 p-3 bg-slate-700/50 rounded-lg hover:bg-slate-700 transition-colors">
                        <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                             alt="{{ $film->title }}" 
                             class="w-16 h-24 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-semibold text-white">{{ $film->title }}</h4>
                            <p class="text-sm text-gray-400">{{ $film->genres->pluck('name')->join(', ') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">No upcoming films</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:init', function () {
        const salesChartData = @json($chartData);

        const salesOptions = {
            series: [{
                name: 'Revenue',
                data: salesChartData.series
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                },
                foreColor: '#9CA3AF',
                background: 'transparent',
                zoom: {
                    enabled: false
                }
            },
            colors: ['#F59E0B'],
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#F59E0B']
                },
                background: {
                    enabled: true,
                    foreColor: '#000',
                    borderRadius: 2,
                    opacity: 0.9,
                    borderWidth: 1,
                    borderColor: '#F59E0B'
                },
                offsetY: -10,
            },
            stroke: {
                curve: 'smooth',
                width: 4
            },
            markers: {
                size: 6,
                colors: ['#F59E0B'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: {
                    size: 8
                }
            },
            xaxis: {
                categories: salesChartData.labels,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                title: {
                    text: 'Revenue (Rp)'
                },
                labels: {
                    formatter: function (value) {
                        return new Intl.NumberFormat('id-ID', { notation: "compact", compactDisplay: "short" }).format(value);
                    }
                }
            },
            grid: {
                borderColor: '#374151',
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function (value) {
                        return "Rp " + new Intl.NumberFormat('id-ID').format(value);
                    }
                }
            },
        };

        const salesChart = new ApexCharts(document.querySelector("#sales-chart"), salesOptions);
        salesChart.render();

        // Bookings Chart
        const bookingsChartData = @json($bookingsChartData);
        const bookingsOptions = {
            series: [{
                name: 'Bookings',
                data: bookingsChartData.series
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false
                },
                foreColor: '#9CA3AF',
                background: 'transparent'
            },
            colors: ['#3B82F6'],
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '60%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: bookingsChartData.labels,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                title: {
                    text: 'Total Bookings'
                }
            },
            grid: {
                borderColor: '#374151',
                strokeDashArray: 4
            },
            tooltip: {
                theme: 'dark'
            }
        };

        const bookingsChart = new ApexCharts(document.querySelector("#bookings-chart"), bookingsOptions);
        bookingsChart.render();
    });
</script>
@endpush
