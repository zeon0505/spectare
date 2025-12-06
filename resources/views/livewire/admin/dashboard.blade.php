<div class="p-6 sm:p-10 bg-slate-950">
    {{-- Header --}}
    <div class="mb-12">
        <h1 class="text-5xl font-black text-white drop-shadow-md mb-2">
            Dashboard Admin
        </h1>
        <p class="text-gray-400 text-lg">Selamat datang kembali, <span class="text-amber-500 font-semibold">{{ Auth::user()->name }}</span></p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        {{-- Total Films --}}
        <div class="group relative bg-gradient-to-br from-amber-500/10 to-slate-800 rounded-2xl shadow-xl shadow-black/40 border border-amber-500/20 p-5 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1 uppercase tracking-wider">Total Films</p>
                    <p class="text-3xl font-black text-white">{{ $totalFilms }}</p>
                    <p class="text-[10px] text-amber-500 mt-1 font-medium">All movies</p>
                </div>
            </div>
        </div>

        {{-- Total Bookings --}}
        <div class="group relative bg-gradient-to-br from-blue-500/10 to-slate-800 rounded-2xl shadow-xl shadow-black/40 border border-blue-500/20 p-5 hover:border-blue-500/50 transition-all duration-300 hover:transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1 uppercase tracking-wider">Total Bookings</p>
                    <p class="text-3xl font-black text-white">{{ $totalBookings }}</p>
                    <p class="text-[10px] text-blue-400 mt-1 font-medium">All tickets</p>
                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="group relative bg-gradient-to-br from-green-500/10 to-slate-800 rounded-2xl shadow-xl shadow-black/40 border border-green-500/20 p-5 hover:border-green-500/50 transition-all duration-300 hover:transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-400 font-medium mb-1 uppercase tracking-wider">Total Revenue</p>
                    <p class="text-lg sm:text-xl font-bold text-white truncate" title="Rp {{ number_format($totalRevenue, 0, ',', '.') }}">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-green-400 mt-1 font-medium">Lifetime earnings</p>
                </div>
            </div>
        </div>

        {{-- Active Shows --}}
        <div class="group relative bg-gradient-to-br from-purple-500/10 to-slate-800 rounded-2xl shadow-xl shadow-black/40 border border-purple-500/20 p-5 hover:border-purple-500/50 transition-all duration-300 hover:transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 font-medium mb-1 uppercase tracking-wider">Active Shows</p>
                    <p class="text-3xl font-black text-white">{{ $activeShows }}</p>
                    <p class="text-[10px] text-purple-400 mt-1 font-medium">Running now</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
        {{-- Sales Chart --}}
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 p-6 hover:border-amber-500/30 transition-all duration-300">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                <span class="w-1 h-6 bg-amber-500 rounded-full mr-3"></span>
                Laporan Keuangan
                <span class="ml-2 text-sm font-normal text-gray-500">(Per-bulan)</span>
            </h3>
            <div id="sales-chart" class="-ml-2" wire:ignore></div>
        </div>

        {{-- Bookings Chart --}}
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 p-6 hover:border-blue-500/30 transition-all duration-300">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                Grafik Pembelian
                <span class="ml-2 text-sm font-normal text-gray-500">(Per-bulan)</span>
            </h3>
            <div id="bookings-chart" class="-ml-2" wire:ignore></div>
        </div>
    </div>

    {{-- Now Showing & Coming Soon --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Now Showing --}}
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-3 animate-pulse"></span>
                    Now Showing
                </h3>
                <a href="{{ route('admin.films.index') }}" class="text-sm text-amber-500 hover:text-amber-400 font-semibold transition-colors">View All &rarr;</a>
            </div>
            <div class="space-y-4">
                @forelse($nowShowingFilms as $film)
                    <div class="group flex items-center space-x-4 p-4 bg-slate-800/50 rounded-xl border border-slate-700/50 hover:bg-slate-800 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:translate-x-2">
                        <div class="relative w-16 h-24 flex-shrink-0 rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                 alt="{{ $film->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-lg mb-1 truncate group-hover:text-amber-500 transition-colors">{{ $film->title }}</h4>
                            <p class="text-sm text-gray-400 mb-2 truncate">{{ $film->genres->pluck('name')->join(', ') }}</p>
                            <div class="flex items-center space-x-3 text-xs text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    {{ $film->rating ?? 'N/A' }}
                                </span>
                                <span>•</span>
                                <span>{{ $film->duration }}m</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 border-2 border-dashed border-slate-800 rounded-xl">
                        <p class="text-gray-500">No films currently showing</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Coming Soon --}}
        <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white flex items-center">
                    <span class="w-2 h-2 bg-amber-500 rounded-full mr-3 animate-pulse"></span>
                    Coming Soon
                </h3>
                <a href="{{ route('admin.films.index') }}" class="text-sm text-amber-500 hover:text-amber-400 font-semibold transition-colors">View All &rarr;</a>
            </div>
            <div class="space-y-4">
                @forelse($comingSoonFilms as $film)
                    <div class="group flex items-center space-x-4 p-4 bg-slate-800/50 rounded-xl border border-slate-700/50 hover:bg-slate-800 hover:border-amber-500/50 transition-all duration-300 hover:transform hover:translate-x-2">
                        <div class="relative w-16 h-24 flex-shrink-0 rounded-lg overflow-hidden shadow-lg opacity-75 group-hover:opacity-100 transition-opacity">
                            <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                 alt="{{ $film->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-lg mb-1 truncate group-hover:text-amber-500 transition-colors">{{ $film->title }}</h4>
                            <p class="text-sm text-gray-400 mb-2 truncate">{{ $film->genres->pluck('name')->join(', ') }}</p>
                            <div class="flex items-center space-x-3 text-xs text-gray-500">
                                <span class="bg-slate-700 px-2 py-0.5 rounded text-gray-300">{{ $film->release_date->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 border-2 border-dashed border-slate-800 rounded-xl">
                        <p class="text-gray-500">No upcoming films</p>
                    </div>
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
