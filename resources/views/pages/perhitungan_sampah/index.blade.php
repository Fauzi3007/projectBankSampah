<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <!-- Filter button -->
                <x-dropdown-filter align="left" />
                <!-- Datepicker built with flatpickr -->
                <x-datepicker />
                <!-- Add view button -->

            </div>
        </div>
        <!-- Cards -->
        <a href="{{ route('perhitungan_sampah.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                <path
                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
            </svg>
            <span class="ml-2">Tambah Perhitungan Sampah</span>
        </a>
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 mt-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gapy-2 px-3">
                <form action="{{ route('filter-sampah') }}" method="POST">
                    @csrf
                    < class="flex flex-col sm:flex-row items-center sm:space-x-4">
                        <div class="flex items-center sm:w-auto ">
                            <select name="operator" id="operator" class="form-input px-5 text-slate-500">
                                <option value="asc">Terkecil</option>
                                <option value="desc">Terbesar</option>
                            </select>
                        </div>
                        <div class="flex items-center mt-2 sm:mt-0">
                            <div class="relative">
                                <input
                                    class="datepicker form-input pl-9 dark:bg-slate-800 text-slate-500 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-200 font-medium w-[15.5rem]"
                                    placeholder="Pilih Tanggal" name="tanggal" data-class="flatpickr-left" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 fill-current text-slate-500 dark:text-slate-400 ml-3"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                    </svg>
                                </div>
                            </div>
                            {{-- DROPDOWN --}}
                            <div class="relative inline-block text-left ml-2 mr-2">
                                <div>
                                    <span class="rounded-md shadow-sm">
                                        <button type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                            id="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                            Pilih Sarana
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <div class="origin-top-right absolute right-0 mt-2 w-96 rounded-md shadow-lg hidden"
                                    id="dropdown-list">
                                    <div class="rounded-md bg-white shadow-xs">
                                        <div class="px-4 py-3">
                                            <div class="grid grid-cols-3 gap-1">
                                                @foreach ($saranas as $loc)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="selectedValues[]"
                                                            value="{{ $loc->id_sarana }}" class="form-checkbox">
                                                        <span class="ml-2">{{ ucwords($loc->nama_sarana) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Skrip dropdown --}}
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Get the dropdown menu element
                                var dropdownMenu = document.getElementById('dropdown-menu');
                                var dropdownList = document.getElementById('dropdown-list');

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
                        <div class="relative inline-block text-left ml-2 mr-2">
                            <div>
                                <span class="rounded-md shadow-sm">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                        id="dropdown-menuuser" aria-haspopup="true" aria-expanded="false">
                                        Pilih User
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
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
                                                    <input type="checkbox" name="selectedUser[]"
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

                        <!-- Kategori Sampah filter -->
                        <h4 class="text-md font-semibold mb-2 mt-2">Kategori Sampah</h4>
                        <div class="relative inline-block text-left ml-2 mr-2">
                            <div>
                                <span class="rounded-md shadow-sm">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                        id="dropdown-menujenis" aria-haspopup="true" aria-expanded="false">
                                        Pilih Kategori Sampah
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
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
                                                    <input type="checkbox" name="selectedJenis[]"
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

                        <!-- Subkategori Sampah filter -->
                        <h4 class="text-md font-semibold mb-2 mt-2">Subkategori Sampah</h4>
                        <div class="relative inline-block text-left ml-2 mr-2">
                            <div>
                                <span class="rounded-md shadow-sm">
                                    <button type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-slate-500 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 ml-2"
                                        id="dropdown-menusubjenis" aria-haspopup="true" aria-expanded="false">
                                        Pilih Subkategori Sampah
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <div class="origin-top-right z-10 absolute left-0 mt-2 w-96 rounded-md shadow-lg hidden"
                                id="dropdown-listsubjenis">
                                <div class="rounded-md bg-white shadow-xs">
                                    <div class="px-4 py-3">
                                        <div class="grid grid-cols-3 gap-1">
                                            @foreach ($subkategoris as $item)
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="selectedSubJenis[]"
                                                        value="{{ $item->id_subkategori }}" class="form-checkbox">
                                                    <span class="ml-2">{{ ucwords($item->nama_subkategori) }}</span>
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
                                var dropdownMenu = document.getElementById('dropdown-menusubjenis');
                                var dropdownList = document.getElementById('dropdown-listsubjenis');

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
                                            <path fill-rule="evenodd" d="M10 12l-6-6 1.5-1.5L10 9.8l4.5-4.5L16 6l-6 6z"
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
                                                    <input type="checkbox" name="selectedProvinsi[]"
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
                        <button type="submit"
                            class="px-4 py-2 rounded-md bg-blue-500 text-white mt-2 sm:mt-0">Filter</button>
            </div>
            </form>
        </div>
        <div
            class="col-span-full  bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Perhitungan Sampah</h2>
            </header>
            <div class="p-3">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <!-- Table header -->
                        <thead
                            class="text-xs font-semibold uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Tanggal</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Sarana</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Kategori</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Jumlah</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                            @forelse($perhitunganSampah as $item)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $loop->iteration }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $item->tanggal }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $item->sarana->nama_sarana }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $item->kategori->nama_kategori }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $item->jumlah_sampah }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $item->user->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap flex justify-center items-center gap-1">
                                        @if (Auth::user()->id == $item->user_id_user || Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                            <a href="{{ route('perhitungan_sampah.edit', $item->id_perhitungan_sampah) }}"
                                                class="px-4 py-2 rounded-md bg-yellow-300 hover:bg-yellow-400 text-white sm:mt-0">Edit</a>
                                            <form
                                                action="{{ route('perhitungan_sampah.destroy', $item->id_perhitungan_sampah) }}"
                                                method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="p-2 rounded-md bg-red-600 hover:bg-red-500 text-white sm:mt-0"
                                                    onclick="return confirm('Yakin akan menghapus data?')"> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-2 whitespace-nowrap">
                                        <div class="text-center">No data available</div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $perhitunganSampah->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
