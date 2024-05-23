<x-app-layout>

  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <form action="{{route('perhitungan_sampah.update',$perhitunganSampah->id_perhitungan_sampah)}}" method="post" class="grid grid-cols-2 gap-6 mt-2">
        @method('PUT')
        @csrf
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

          <x-label for="tanggal">{{ __('Tanggal') }} </x-label>
          <x-input id="tanggal" type="text" name="tanggal" :value="old('tanggal',$perhitunganSampah->tanggal)"
              required />

        <x-label for="kategori_id_kategori">{{ __('Kategori') }} </x-label>
        <select id="kategori_id_kategori" name="kategori_id_kategori" :value="old('kategori_id_kategori')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="" disabled selected>Select an option</option>
            @foreach($kategoris as $item)
                <option value="{{ $item->id_kategori }}" {{$perhitunganSampah->kategori_id_kategori === $item->id_kategori ? 'selected' : ''}}>{{ $item->nama_kategori }}</option>
            @endforeach
        </select>
        <x-label for="kategori_id_kategori">{{ __('Kategori') }} </x-label>
        <select id="kategori_id_kategori" name="kategori_id_kategori" :value="old('kategori_id_kategori')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="" disabled selected>Select an option</option>
            @foreach($subkategoris as $item)
                <option value="{{ $item->id_subkategori }}" {{$perhitunganSampah->subkategori_id_subkategori === $item->id_subkategori ? 'selected' : ''}}>{{ $item->nama_subkategori }}</option>
            @endforeach
        </select>

          <x-label for="jumlah_sampah">{{ __('Jumlah Sampah') }} </x-label>
          <x-input id="jumlah_sampah" type="number" name="jumlah_sampah" :value="old('jumlah_sampah',$perhitunganSampah->jumlah_sampah)" required />

        <x-label for="sarana_id_sarana">{{ __('Sarana') }} </x-label>
        <select id="sarana_id_sarana" name="sarana_id_sarana" :value="old('sarana_id_sarana')" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="" disabled selected>Select an option</option>
            @foreach($saranas as $item)
                <option value="{{ $item->id_sarana }}" {{$perhitunganSampah->sarana_id_sarana === $item->id_sarana ? 'selected' : ''}}>{{ $item->nama_sarana }}</option>
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

</x-app-layout>
