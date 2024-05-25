<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen"
                aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="block" href="{{ route('dashboard') }}">
                <p class="text-md text-green-600  dark:text-slate-100 font-bold mb-6">{{ __('Naima Eco Sync') }}</p>

            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Pages</span>
                </h3>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-slate-900' }} @endif">
                        <a title="Dashboard"
                            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-slate-200' }} @endif"
                            href="{{ route('dashboard') }}">
                            <div class="flex items-center justify-between">
                                <div class="grow flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 14 14">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['dashboard'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                            fill="#8fbffa" fill-rule="evenodd"
                                            d="M1 0a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h4a1 1 0 0 0 1 -1V1a1 1 0 0 0 -1 -1H1Zm7 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v2.01a1 1 0 0 1 -1 1H9a1 1 0 0 1 -1 -1V1Zm0 6a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1H9a1 1 0 0 1 -1 -1V7Zm-8 3.99a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1V13a1 1 0 0 1 -1 1H1a1 1 0 0 1 -1 -1v-2.01Z"
                                            clip-rule="evenodd" stroke-width="1"></path>
                                    </svg>

                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                </div>

                                {{-- <!-- Badge -->
                                <div class="flex flex-shrink-0 ml-2">
                                    <span class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-indigo-500 px-2 rounded">4</span>
                                </div> --}}
                            </div>

                        </a>
                    </li>
                    <!-- Sarana -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['sarana'])) {{ 'bg-slate-900' }} @endif">
                        <a title="Sarana"
                            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['sarana'])) {{ 'hover:text-slate-200' }} @endif"
                            href="{{ route('sarana.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 14 14">
                                    <path
                                        class="fill-current @if (Request::segment(1) === 'sarana') {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                        fill="#8fbffa" fill-rule="evenodd"
                                        d="M5.62564 1.3093c0.98107 -1.645262 3.33698 -1.719642 4.41986 -0.13955l0.5939 0.86648 0.8193 -0.40484c0.2315 -0.11434 0.5094 -0.07464 0.6996 0.09993 0.1901 0.17457 0.2534 0.44809 0.1592 0.68843l-1.1506 2.93644c-0.1165 0.29744 -0.4386 0.45912 -0.7468 0.37484l-3.08498 -0.84375c-0.25038 -0.06848 -0.43237 -0.28459 -0.45724 -0.54297 -0.02487 -0.25838 0.11255 -0.50524 0.34527 -0.62023l0.68605 -0.33895 -0.56125 -0.88097c-0.13389 -0.21016 -0.43171 -0.2337 -0.59695 -0.0472L5.62839 3.72398c-0.21389 0.24141 -0.57634 0.28041 -0.8367 0.09004 -0.26035 -0.19037 -0.33309 -0.54759 -0.1679 -0.82461L5.62564 1.3093ZM3.77518 4.66759c0.31587 -0.04778 0.61693 0.15033 0.69802 0.45933l0.81179 3.09355c0.06588 0.25108 -0.03028 0.51674 -0.24161 0.66747 -0.21133 0.15073 -0.49383 0.15515 -0.70977 0.0111l-0.63658 -0.42467 -0.48232 0.92653c-0.11506 0.22103 0.01346 0.49072 0.2576 0.54058l1.65858 0.33872c0.31601 0.0645 0.53101 0.3589 0.49632 0.6796 -0.03469 0.3206 -0.30768 0.5622 -0.63018 0.5577l-1.95595 -0.0276C1.12571 11.4629 -0.116658 9.45981 0.710289 7.73194l0.453471 -0.94751 -0.760266 -0.50718C0.188753 6.134 0.0841754 5.87346 0.140276 5.62149c0.056102 -0.25197 0.261337 -0.44352 0.516572 -0.48213l3.118332 -0.47177Zm3.38714 6.55251c-0.19932 -0.2496 -0.17828 -0.6094 0.04879 -0.8341L9.4843 8.13617c0.1845 -0.1826 0.46265 -0.23215 0.6989 -0.1245 0.2362 0.10765 0.3812 0.3501 0.3644 0.60913l-0.0494 0.76365 1.0436 -0.04557c0.2489 -0.01087 0.4182 -0.25702 0.3393 -0.49338l-0.536 -1.60571c-0.1021 -0.30594 0.0454 -0.63934 0.3404 -0.76963 0.295 -0.13028 0.6408 -0.01466
                                    0.7981 0.2669l0.9541 1.70769c0.9343 1.67225 -0.1793 3.74975 -2.0891 3.89745l-1.0473 0.0811 -0.0591 0.912c-0.0167 0.2576 -0.1901 0.4784 -0.43632 0.5558 -0.24626 0.0774 -0.51477 -0.0046 -0.67583 -0.2063l-1.96773 -2.4647Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                    </g>
                                </svg>


                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sarana</span>
                            </div>
                        </a>
                    </li>
                    <!-- Perhitungan Sampah -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'bg-slate-900' }} @endif">
                        <a title="Perhitungan Sampah"
                            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'hover:text-slate-200' }} @endif"
                            href="{{ route('perhitungan_sampah.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 14 14">
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                        fill="#8fbffa" fill-rule="evenodd"
                                        d="M2.59 0.14C1.7781 0.14 1.12 0.7981 1.12 1.61V12.39C1.12 13.2019 1.7781 13.86 2.59 13.86H11.41C12.2219 13.86 12.88 13.2019 12.88 12.39V4.9557C12.8797 4.566 12.7246 4.1923 12.4488 3.9169L9.1031 0.5702C8.8275 0.2948 8.4539 0.1401 8.0643 0.14H2.59Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-600' }} @endif"
                                        fill="#2859c5" fill-rule="evenodd"
                                        d="M7.0598 6.3875C7.0598 5.9816 7.3888 5.6525 7.7948 5.6525H10.2448C10.8106 5.6525 11.1642 6.265 10.8813 6.755C10.75 6.9824 10.5074 7.1225 10.2448 7.1225H7.7948C7.3889 7.1225 7.0598 6.7934 7.0598 6.3875Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-600' }} @endif"
                                        fill="#2859c5" fill-rule="evenodd"
                                        d="M7.0598 10.2771C7.0598 9.8712 7.3888 9.5421 7.7948 9.5421H10.2448C10.8106 9.5421 11.1642 10.1547 10.8813 10.6446C10.75 10.872 10.5074 11.0121 10.2448 11.0121H7.7948C7.3888 11.0121 7.0598 10.6831 7.0598 10.2771Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-600' }} @endif"
                                        fill="#2859c5" fill-rule="evenodd"
                                        d="M6.1288 8.5288C6.4592 8.7645 6.5359 9.2234 6.3003 9.5539L4.9312 11.4688C4.6671 11.8378 4.135 11.8817 3.814 11.5609L2.9928 10.7407C2.5995 10.3339 2.7941 9.6539 3.343 9.5167C3.5889 9.4553 3.8492 9.5249 4.0316 9.7009L4.2393 9.9086L5.1037 8.6983C5.34 8.3686 5.7989 8.2927 6.1288 8.5288Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['perhitungan_sampah'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-600' }} @endif"
                                        fill="#2859c5" fill-rule="evenodd"
                                        d="M6.1288 4.5774C6.4598 4.8132 6.5366 5.2729 6.3003 5.6035L4.9312 7.5194C4.6671 7.8884 4.135 7.9323 3.814 7.6115L2.9928 6.7903C2.6071 6.3763 2.8141 5.7001 3.3654 5.573C3.6034 5.5182 3.853 5.585 4.0316 5.7515L4.2393 5.9583L5.1037 4.7489C5.3394 4.4186 5.7983 4.3418 6.1288 4.5774Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </svg>

                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Perhitungan
                                    Sampah</span>
                            </div>

                        </a>
                    </li>

                    <!-- kategori -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['kategori'])) {{ 'bg-slate-900' }} @endif">
                        <a title="Kategori"
                            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['kategori'])) {{ 'hover:text-slate-200' }} @endif"
                            href="{{ route('kategori.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['kategori'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                        fill="#8fbffa" fill-rule="evenodd"
                                        d="M23 5H1V3h22v2Zm0 8H1v-2h22v2ZM1 21h22v-2H1v2Z" clip-rule="evenodd"
                                        stroke-width="1"></path>
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['kategori'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-600' }} @endif"
                                        fill="#2859c5" fill-rule="evenodd"
                                        d="M7 4a3 3 0 1 1 -6 0 3 3 0 0 1 6 0Zm8 8a3 3 0 1 1 -6 0 3 3 0 0 1 6 0Zm5 11a3 3 0 1 0 0 -6 3 3 0 0 0 0 6Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </svg>

                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Kategori</span>
                            </div>
                        </a>
                    </li>
                    <!-- Subkategori -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['subkategori'])) {{ 'bg-slate-900' }} @endif">
                        <a title="Subkategori"
                            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['subkategori'])) {{ 'hover:text-slate-200' }} @endif"
                            href="{{ route('subkategori.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['subkategori'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                        fill="#8fbffa" fill-rule="evenodd"
                                        d="M23 5H1V3h22v2Zm0 8H1v-2h22v2ZM1 21h22v-2H1v2Z" clip-rule="evenodd"
                                        stroke-width="1"></path>
                                    <path
                                        class="fill-current @if (in_array(Request::segment(1), ['subkategori'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-600' }} @endif"
                                        fill="#2859c5" fill-rule="evenodd"
                                        d="M7 4a3 3 0 1 1 -6 0 3 3 0 0 1 6 0Zm8 8a3 3 0 1 1 -6 0 3 3 0 0 1 6 0Zm5 11a3 3 0 1 0 0 -6 3 3 0 0 0 0 6Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </svg>

                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Subkategori</span>
                            </div>
                        </a>
                    </li>

                    <!-- Provinsi -->
                    @if ( Auth::user()->role == 'super admin')
                        <li
                            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['provinsi'])) {{ 'bg-slate-900' }} @endif">
                            <a title="Provinsi"
                                class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['provinsi'])) {{ 'hover:text-slate-200' }} @endif"
                                href="{{ route('provinsi.index') }}">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['provinsi'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                            fill="#8fbffa" fill-rule="evenodd"
                                            d="M23 5H1V3h22v2Zm0 8H1v-2h22v2ZM1 21h22v-2H1v2Z" clip-rule="evenodd"
                                            stroke-width="1"></path>
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['provinsi'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-600' }} @endif"
                                            fill="#2859c5" fill-rule="evenodd"
                                            d="M7 4a3 3 0 1 1 -6 0 3 3 0 0 1 6 0Zm8 8a3 3 0 1 1 -6 0 3 3 0 0 1 6 0Zm5 11a3 3 0 1 0 0 -6 3 3 0 0 0 0 6Z"
                                            clip-rule="evenodd" stroke-width="1"></path>
                                    </svg>

                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Provinsi</span>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- Pengguna -->
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super admin')
                        <li
                            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['pengguna_sarana'])) {{ 'bg-slate-900' }} @endif">
                            <a title="pengguna_sarana"
                                class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['pengguna_sarana'])) {{ 'hover:text-slate-200' }} @endif"
                                href="{{ route('pengguna_sarana.index') }}">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 14 14">
                                        <path
                                            class="fill-current @if (Request::segment(1) === 'pengguna_sarana') {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                            fill="#8fbffa" fill-rule="evenodd"
                                            d="M3.164 4.462a1.715 1.715 0 1 0 0 -3.431 1.715 1.715 0 0 0 0 3.43Zm7.672 0a1.715 1.715 0 1 0 0 -3.431 1.715 1.715 0 0 0 0 3.43Zm0 0.357a3.06 3.06 0 0 0 -1.898 0.656 2.959 2.959 0 0 1 0.95 2.917h3.521a0.5 0.5 0 0 0 0.5 -0.5 3.073 3.073 0 0 0 -3.073 -3.073Zm-7.672 0a3.06 3.06 0 0 1 1.898 0.656 2.959 2.959 0 0 0 -0.95 2.917H0.59a0.5 0.5 0 0 1 -0.5 -0.5A3.073 3.073 0 0 1 3.164 4.82ZM7 9.435a1.715 1.715 0 1 0 0 -3.43 1.715 1.715 0 0 0 0 3.43Zm-3.073 3.43a3.073 3.073 0 0 1 6.146 0 0.5 0.5 0 0 1 -0.5 0.5H4.427a0.5 0.5 0 0 1 -0.5 -0.5Z"
                                            clip-rule="evenodd" stroke-width="1"></path>
                                    </svg>

                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pengguna
                                        Sarana</span>
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400"
                            d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
