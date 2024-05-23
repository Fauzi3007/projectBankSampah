<x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('[role="tab"]');
            const tabPanels = document.querySelectorAll('[role="tabpanel"]');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    activateTab(button);
                });
            });

            function activateTab(button) {
                tabButtons.forEach(btn => {
                    btn.classList.remove('hs-tab-active', 'font-semibold', 'border-blue-600', 'text-blue-600');
                    btn.classList.add('text-gray-500');
                });
                button.classList.add('hs-tab-active', 'font-semibold', 'border-blue-600', 'text-blue-600');
                button.classList.remove('text-gray-500');

                tabPanels.forEach(panel => {
                    panel.classList.add('hidden');
                });

                const targetPanelId = button.getAttribute('data-hs-tab');
                const targetPanel = document.querySelector(targetPanelId);
                targetPanel.classList.remove('hidden');
            }
        });
    </script>



  <div class="px-4 sm:px-6 lg:px-8 py-4 w-full max-w-9xl mx-auto">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-0.5 flex justify-center space-x-6" aria-label="Tabs" role="tablist">
            <button type="button" class="hs-tab-active font-semibold border-blue-600 text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap  hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active" id="horizontal-alignment-item-1" data-hs-tab="#horizontal-alignment-1" aria-controls="horizontal-alignment-1" role="tab">
                Upload Manual
            </button>
            <button type="button" class="font-semibold py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" id="horizontal-alignment-item-2" data-hs-tab="#horizontal-alignment-2" aria-controls="horizontal-alignment-2" role="tab">
                Upload Excel
            </button>


        </nav>
    </div>

      <div class="mt-3">
        <div id="horizontal-alignment-1" role="tabpanel" aria-labelledby="horizontal-alignment-item-1">
            <form action="{{route('perhitungan_sampah.store')}}" method="post" class="grid grid-cols-2 gap-6 mt-2">
                @csrf
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <input type="text" name="user_id_user" value="{{Auth::user()->id}}" hidden>

                  <x-label for="tanggal">{{ __('Tanggal') }} </x-label>
                  <x-input id="tanggal" type="date" name="tanggal" :value="old('tanggal')"
                      required />

                <x-label for="kategori_id_kategori">{{ __('Kategori') }} </x-label>
                <select id="kategori_id_kategori" name="kategori_id_kategori" :value="old('kategori_id_kategori')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="" disabled selected>Select an option</option>
                    @foreach($kategoris as $item)
                        <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>

                <x-label for="kategori_id_kategori">{{ __('Kategori') }} </x-label>
                <select id="kategori_id_kategori" name="kategori_id_kategori" :value="old('kategori_id_kategori')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="" disabled selected>Select an option</option>
                    @foreach($subkategoris as $item)
                        <option value="{{ $item->id_subkategori }}">{{ $item->nama_subkategori }}</option>
                    @endforeach
                </select>

                  <x-label for="jumlah_sampah">{{ __('Jumlah Sampah') }} </x-label>
                  <x-input id="jumlah_sampah" type="number" name="jumlah_sampah" :value="old('jumlah_sampah')" required />

                <x-label for="sarana_id_sarana">{{ __('Sarana') }} </x-label>
                <select id="sarana_id_sarana" name="sarana_id_sarana" :value="old('sarana_id_sarana')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="" disabled selected>Select an option</option>
                    @foreach($saranas as $item)
                        <option value="{{ $item->id_sarana }}">{{ $item->nama_sarana }}</option>
                    @endforeach
                </select>

              </div>

              <div class="flex items-center justify-between mt-6 col-span-2">
                  <x-button type="submit">
                      {{ __('Simpan') }}
                  </x-button>
              </div>
          </form>
          <x-validation-errors class="mt-4" />
        </div>
        <div id="horizontal-alignment-2" class="hidden" role="tabpanel" aria-labelledby="horizontal-alignment-item-2">
            <form action="{{route('excel.upload')}}" enctype="multipart/form-data" method="post" class="grid grid-cols-2 gap-6 mt-2">
                @csrf
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <input type="text" name="user_id_user" value="{{Auth::user()->id}}" hidden>


                  <x-label for="tanggal">{{ __('Tanggal') }} </x-label>
                  <x-input id="tanggal" type="date" name="tanggal" :value="old('tanggal')"
                      required />

                      <x-label for="sarana_id_sarana">{{ __('Sarana') }} </x-label>
                      <select id="sarana_id_sarana" name="sarana_id_sarana" :value="old('sarana_id_sarana')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="" disabled selected>Select an option</option>
                          @foreach($saranas as $item)
                              <option value="{{ $item->id_sarana }}">{{ $item->nama_sarana }}</option>
                          @endforeach
                      </select>

                  <x-label for="file_excel">{{ __('File Excel') }} </x-label>
                  <x-input id="file_excel" type="file" name="file_excel"
                  name="excel_file"
                  accept=".xlsx,.xls" :value="old('file_excel')" required />
                 <a class="text-blue-600" href="/download-excel">Download template.xlsx</a>


              </div>

              <div class="flex items-center justify-between mt-6 col-span-2">
                  <x-button type="submit">
                      {{ __('Simpan') }}
                  </x-button>
              </div>
          </form>
          <x-validation-errors class="mt-4" />
        </div>

      </div>

  </div>

</x-app-layout>
