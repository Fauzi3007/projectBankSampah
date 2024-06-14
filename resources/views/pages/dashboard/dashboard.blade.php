    <x-app-layout>
        <div class="px-4 sm:px-6 lg:px-8 py-4 w-full max-w-9xl mx-auto">


            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">Dashboard</h1>
                {{-- <a href="{{ route('dashboard.export') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export</a> --}}
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <!-- Flatpickr CDN -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">



            <!-- Cards -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-3">

                    <div class="bg-white rounded-lg shadow p-4">
                        <form action="{{ route('filter') }}" method="post">
                            @csrf

                            <!-- Tanggal -->
                            <div class="mb-4">
                                <label for="selectedTanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <div class="relative mt-1">
                                    <input id="selectedTanggal" name="selectedTanggal" type="text"
                                        class="datepicker form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Pilih Tanggal" data-class="flatpickr-left">

                                </div>
                            </div>

                            <!-- Provinsi filter -->
                            <div class="mb-4">
                                <label for="dropdown-menuprovinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                                <div class="relative">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                                        id="dropdown-menuprovinsi" aria-haspopup="true" aria-expanded="false">
                                        Pilih Provinsi
                                        <svg class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div
                                        class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden bg-white border border-gray-200"
                                        id="dropdown-listprovinsi">
                                        <div class="rounded-md shadow-xs">
                                            <div class="px-4 py-3 grid grid-cols-3 gap-1">
                                                @foreach ($provinsis as $provinsi)
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="selectedProvinsi[]" value="{{ $provinsi->id_provinsi }}"
                                                        class="form-checkbox rounded text-blue-500">
                                                    <span class="ml-2 text-gray-700">{{ ucwords($provinsi->nama_provinsi) }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sarana filter -->
                            <div class="mb-4">
                                <label for="dropdown-menuuser" class="block text-sm font-medium text-gray-700">Sarana</label>
                                <div class="relative">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                                        id="dropdown-menuuser" aria-haspopup="true" aria-expanded="false">
                                        Pilih Sarana
                                        <svg class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div
                                        class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden bg-white border border-gray-200"
                                        id="dropdown-listuser">
                                        <div class="rounded-md shadow-xs">
                                            <div class="px-4 py-3 grid grid-cols-3 gap-1">
                                                @foreach ($saranas as $sarana)
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="selectedUser[]" value="{{ $sarana->id_sarana }}"
                                                        class="form-checkbox rounded text-blue-500">
                                                    <span
                                                        class="ml-2 text-gray-700">{{ Str::limit(ucwords($sarana->nama_sarana), 25, '..') }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kategori Sampah filter -->
                            <div class="mb-4">
                                <label for="dropdown-menujenis" class="block text-sm font-medium text-gray-700">Kategori Sampah</label>
                                <div class="relative">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                                        id="dropdown-menujenis" aria-haspopup="true" aria-expanded="false">
                                        Pilih Kategori
                                        <svg class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div
                                        class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden bg-white border border-gray-200"
                                        id="dropdown-listjenis">
                                        <div class="rounded-md shadow-xs">
                                            <div class="px-4 py-3 grid grid-cols-3 gap-1">
                                                @foreach ($kategoris as $kategori)
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="selectedJenis[]" value="{{ $kategori->id_kategori }}"
                                                        class="form-checkbox rounded text-blue-500">
                                                    <span class="ml-2 text-gray-700">{{ ucwords($kategori->nama_kategori) }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subkategori Sampah filter -->
                            <div class="mb-4">
                                <label for="dropdown-menusubjenis" class="block text-sm font-medium text-gray-700">Subkategori Sampah</label>
                                <div class="relative">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                                        id="dropdown-menusubjenis" aria-haspopup="true" aria-expanded="false">
                                        Pilih Subkategori
                                        <svg class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div
                                        class="origin-top-right z-10 absolute left-0
                    mt-2 w-96 rounded-md shadow-lg hidden bg-white border border-gray-200"
                    id="dropdown-listsubjenis">
                    <div class="rounded-md shadow-xs">
                        <div class="px-4 py-3 grid grid-cols-3 gap-1">
                            @foreach ($subkategoris as $subkategori)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="selectedSubjenis[]"
                                    value="{{ $subkategori->id_subkategori }}"
                                    class="form-checkbox rounded text-blue-500">
                                <span
                                    class="ml-2 text-gray-700">{{ ucwords($subkategori->nama_subkategori) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Button -->
        <div class="mt-4">
            <input type="submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out"
                value="Filter">
        </div>
    </form>
</div>

                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function setupDropdown(menuId, listId) {
                            const dropdownMenu = document.getElementById(menuId);
                            const dropdownList = document.getElementById(listId);

                            function toggleDropdown() {
                                dropdownList.classList.toggle('hidden');
                                dropdownMenu.setAttribute('aria-expanded', !dropdownList.classList.contains('hidden'));
                            }

                            document.addEventListener('click', function(event) {
                                if (!dropdownMenu.contains(event.target) && !event.target.classList.contains(
                                        'form-checkbox')) {
                                    dropdownList.classList.add('hidden');
                                    dropdownMenu.setAttribute('aria-expanded', 'false');
                                }
                            });

                            dropdownMenu.addEventListener('click', toggleDropdown);

                            document.querySelectorAll('.form-checkbox').forEach(checkbox => {
                                checkbox.addEventListener('click', event => {
                                    event.stopPropagation();
                                });
                            });
                        }

                        setupDropdown('dropdown-menuuser', 'dropdown-listuser');
                        setupDropdown('dropdown-menujenis', 'dropdown-listjenis');
                        setupDropdown('dropdown-menusubjenis', 'dropdown-listsubjenis');
                        setupDropdown('dropdown-menuprovinsi', 'dropdown-listprovinsi');
                    });
                </script>




                <div class="grid grid-cols-12 col-span-9">

                    <div class="col-span-6 bg-white rounded-lg shadow p-2 mr-2">
                        <canvas id="userChart" class="w-full" style="height: 35rem;"></canvas>
                    </div>

                    <div class="col-span-6 bg-white rounded-lg shadow p-2">
                        <canvas id="jenisChart" class="w-full" style="height: 20rem;"></canvas>
                    </div>
                </div>

                <div class="col-span-12 bg-white rounded-lg shadow p-2">
                    <canvas id="provinsiChart" class="w-full" style="height: 25rem;"></canvas>
                </div>

            </div>


            <!-- Filter sidebar -->

            <script>
                flatpickr("#dateRangePicker", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "Y/m/d",
                });

                document.addEventListener('DOMContentLoaded', function() {


                var userCtx = document.getElementById('userChart').getContext('2d');
                var saranalabels = [];
                var saranaDatasets = [];
                @foreach ($stackedBarData as $saranaId => $saranaData)
                    @foreach ($saranaData as $data)
                        saranalabels.push({!! json_encode($data->nama_sarana) !!});
                        saranaDatasets.push({
                            label: {!! json_encode($data->nama_sarana) !!},
                            data: [{!! json_encode($data->total_sampah) !!}],
                            backgroundColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                            borderColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                            borderWidth: 1
                        });
                    @endforeach
                @endforeach
                var userChart = new Chart(userCtx, {
                    type: 'bar',
                    data: {
                        labels: saranalabels,
                        datasets: saranaDatasets
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Jumlah Sampah per Sarana (Kg)',
                                font: {
                                    size: 10
                                }
                            },
                            tooltip: {
                                enabled: true,
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                titleFont: {
                                    size: 12
                                },
                                bodyFont: {
                                    size: 10
                                }
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.2)'
                                }
                            }
                        }
                    }
                });

                var jenisCtx = document.getElementById('jenisChart').getContext('2d');
                var jenisChart = new Chart(jenisCtx, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($pieChartData->pluck('kategori.nama_kategori')) !!},
                        datasets: [{
                            data: {!! json_encode($pieChartData->pluck('percentage')) !!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Presentase Jenis Sampah Terlapor (%)',
                                font: {
                                    size: 12
                                }
                            },
                            tooltip: {
                                enabled: true,
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                titleFont: {
                                    size: 12
                                },
                                bodyFont: {
                                    size: 10
                                }
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                });

                var provinsiCtx = document.getElementById('provinsiChart').getContext('2d');
                var labels = [];
                var datasets = [];
                @foreach ($barChartData as $provinceId => $provinceData)
                    @foreach ($provinceData as $data)
                        labels.push({!! json_encode($data->nama_provinsi) !!});
                        datasets.push({
                            label: {!! json_encode($data->nama_provinsi) !!},
                            data: [{!! json_encode($data->total_sampah) !!}],
                            backgroundColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                            borderColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                            borderWidth: 1
                        });
                    @endforeach
                @endforeach

                var provinsiChart = new Chart(provinsiCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Lokasi Sampah Terlapor (Kg)',
                                font: {
                                    size: 12
                                }
                            },
                            tooltip: {
                                enabled: true,
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                titleFont: {
                                    size: 12
                                },
                                bodyFont: {
                                    size: 10
                                }
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.2)'
                                }
                            }
                        }
                    }
                });
            });
            </script>

        </div>
    </x-app-layout>
