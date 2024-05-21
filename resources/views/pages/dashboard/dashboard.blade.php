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
                    <div class="bg-white rounded-lg shadow p-3">
                        <h3 class="text-lg font-semibold mb-2">Tanggal</h3>
                        <form action="{{route('filter')}}" method="post">
                            @csrf
                            <div class="relative mb-2">
                                <input
                                    class="datepicker form-input pl-9 dark:bg-slate-800 text-slate-500 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-200 font-medium w-[14rem]"
                                    placeholder="Pilih Tanggal" name="selectedTanggal" data-class="flatpickr-left" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 fill-current text-slate-500 dark:text-slate-400 ml-3"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                    </svg>
                                </div>
                            </div>


                            <!-- Users filter -->
                            <h4 class="text-md font-semibold mb-2">Users</h4>
                            <div class="relative inline-block text-left ml-2 mr-2">
                                <div>
                                    <span class="rounded-md shadow-sm">
                                        <button type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                            id="dropdown-menuuser" aria-haspopup="true" aria-expanded="false">
                                            Pilih User
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <div class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden"
                                    id="dropdown-listuser">
                                    <div class="rounded-md bg-white shadow-xs">
                                        <div class="px-4 py-3">
                                            <div class="grid grid-cols-3 gap-1">
                                                @foreach ($users as $item)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="selectedProvinsi[]"
                                                            value="{{ $item->id }}" class="form-checkbox">
                                                        <span
                                                            class="ml-2">{{ Str::limit(ucwords($item->name), 10, '..') }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Skrip dropdown --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Get the dropdown menu element
                                    var dropdownMenu = document.getElementById('dropdown-menuuser');
                                    var dropdownList = document.getElementById('dropdown-listuser');

                                    // Toggle the dropdown menu
                                    function toggleDropdown() {
                                        if (dropdownList.classList.contains('hidden')) {
                                            dropdownList.classList.remove('hidden');
                                            dropdownMenu.setAttribute('aria-expanded', 'true');
                                        } else {
                                            dropdownList.classList.add('hidden');
                                            dropdownMenu.setAttribute('aria-expanded', 'false');
                                        }
                                    }

                                    // Close the dropdown menu when clicked outside
                                    document.addEventListener('click', function(event) {
                                        var target = event.target;

                                        if (!dropdownMenu.contains(target) && !target.classList.contains('form-checkbox')) {
                                            if (!dropdownList.classList.contains('hidden')) {
                                                dropdownList.classList.add('hidden');
                                                dropdownMenu.setAttribute('aria-expanded', 'false');
                                            }
                                        }
                                    });

                                    // Add event listener to toggle the dropdown menu when clicked
                                    dropdownMenu.addEventListener('click', toggleDropdown);

                                    // Prevent dropdown menu from closing when clicking checkboxes
                                    var checkboxes = document.querySelectorAll('.form-checkbox');
                                    checkboxes.forEach(function(checkbox) {
                                        checkbox.addEventListener('click', function(event) {
                                            event.stopPropagation();
                                        });
                                    });
                                });
                            </script>

                            <!-- Jenis Sampah filter -->
                            <h4 class="text-md font-semibold mb-2 mt-2">Jenis Sampah</h4>
                            <div class="relative inline-block text-left ml-2 mr-2">
                                <div>
                                    <span class="rounded-md shadow-sm">
                                        <button type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                            id="dropdown-menujenis" aria-haspopup="true" aria-expanded="false">
                                            Pilih Jenis Sampah
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <div class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden"
                                    id="dropdown-listjenis">
                                    <div class="rounded-md bg-white shadow-xs">
                                        <div class="px-4 py-3">
                                            <div class="grid grid-cols-3 gap-1">
                                                @foreach ($kategoris as $item)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="selectedUser[]"
                                                            value="{{ $item->id_kategori }}" class="form-checkbox">
                                                        <span class="ml-2">{{ ucwords($item->nama_kategori) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Get the dropdown menu element
                                    var dropdownMenu = document.getElementById('dropdown-menujenis');
                                    var dropdownList = document.getElementById('dropdown-listjenis');

                                    // Toggle the dropdown menu
                                    function toggleDropdown() {
                                        if (dropdownList.classList.contains('hidden')) {
                                            dropdownList.classList.remove('hidden');
                                            dropdownMenu.setAttribute('aria-expanded', 'true');
                                        } else {
                                            dropdownList.classList.add('hidden');
                                            dropdownMenu.setAttribute('aria-expanded', 'false');
                                        }
                                    }

                                    // Close the dropdown menu when clicked outside
                                    document.addEventListener('click', function(event) {
                                        var target = event.target;

                                        if (!dropdownMenu.contains(target) && !target.classList.contains('form-checkbox')) {
                                            if (!dropdownList.classList.contains('hidden')) {
                                                dropdownList.classList.add('hidden');
                                                dropdownMenu.setAttribute('aria-expanded', 'false');
                                            }
                                        }
                                    });

                                    // Add event listener to toggle the dropdown menu when clicked
                                    dropdownMenu.addEventListener('click', toggleDropdown);

                                    // Prevent dropdown menu from closing when clicking checkboxes
                                    var checkboxes = document.querySelectorAll('.form-checkbox');
                                    checkboxes.forEach(function(checkbox) {
                                        checkbox.addEventListener('click', function(event) {
                                            event.stopPropagation();
                                        });
                                    });
                                });
                            </script>

                            <!-- Provinsi filter -->
                            <h4 class="text-md font-semibold mb-2 mt-2">Provinsi</h4>
                            <div class="relative inline-block text-left ml-2 mr-2 mb-6">
                                <div>
                                    <span class="rounded-md shadow-sm">
                                        <button type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                            id="dropdown-menuprovinsi" aria-haspopup="true" aria-expanded="false">
                                            Pilih Provinsi
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <div class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden"
                                    id="dropdown-listprovinsi">
                                    <div class="rounded-md bg-white shadow-xs">
                                        <div class="px-4 py-3">
                                            <div class="grid grid-cols-3 gap-1">
                                                @foreach ($provinsis as $item)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="selectedJenis[]"
                                                            value="{{ $item->id_provinsi }}" class="form-checkbox">
                                                        <span class="ml-2">{{ ucwords($item->nama_provinsi) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Get the dropdown menu element
                                    var dropdownMenu = document.getElementById('dropdown-menuprovinsi');
                                    var dropdownList = document.getElementById('dropdown-listprovinsi');

                                    // Toggle the dropdown menu
                                    function toggleDropdown() {
                                        if (dropdownList.classList.contains('hidden')) {
                                            dropdownList.classList.remove('hidden');
                                            dropdownMenu.setAttribute('aria-expanded', 'true');
                                        } else {
                                            dropdownList.classList.add('hidden');
                                            dropdownMenu.setAttribute('aria-expanded', 'false');
                                        }
                                    }

                                    // Close the dropdown menu when clicked outside
                                    document.addEventListener('click', function(event) {
                                        var target = event.target;

                                        if (!dropdownMenu.contains(target) && !target.classList.contains('form-checkbox')) {
                                            if (!dropdownList.classList.contains('hidden')) {
                                                dropdownList.classList.add('hidden');
                                                dropdownMenu.setAttribute('aria-expanded', 'false');
                                            }
                                        }
                                    });

                                    // Add event listener to toggle the dropdown menu when clicked
                                    dropdownMenu.addEventListener('click', toggleDropdown);

                                    // Prevent dropdown menu from closing when clicking checkboxes
                                    var checkboxes = document.querySelectorAll('.form-checkbox');
                                    checkboxes.forEach(function(checkbox) {
                                        checkbox.addEventListener('click', function(event) {
                                            event.stopPropagation();
                                        });
                                    });
                                });
                            </script>

                            <!-- Filter Button -->
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-full rounded mt-4">Filter</button>
                </div>

                </form>



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


                var userCtx = document.getElementById('userChart').getContext('2d');
                var userChart = new Chart(userCtx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($users->pluck('name')); ?>,
                        datasets: [
                            @foreach ($stackedBarData as $userId => $data)
                                {
                                    label: '{{ $users->find($userId)->name }}',
                                    data: {!! json_encode($data->pluck('total_sampah')) !!},
                                    backgroundColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    borderColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                                    borderWidth: 1
                                },
                            @endforeach
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Jumlah Sampah Terlapor (Kg)',
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
                var provinsiChart = new Chart(provinsiCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($provinsis->pluck('nama_provinsi')) !!},
                        datasets: [
                            @foreach ($barChartData as $provinsiId => $data)
                                {
                                    label: '{{ $provinsis->find($provinsiId)->nama_provinsi }}',
                                    data: {!! json_encode($data->pluck('total_sampah')) !!},
                                    backgroundColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    borderColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                                    borderWidth: 1
                                },
                            @endforeach
                        ]
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
            </script>

        </div>
    </x-app-layout>
