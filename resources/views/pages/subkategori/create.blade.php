<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{ route('subkategori.store') }}" method="post" class="grid grid-cols-2 gap-6 mt-2">
            @csrf
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <x-label for="nama_subkategori">{{ __('Nama Subkategori') }} </x-label>
                <x-input id="nama_subkategori" type="text" name="nama_subkategori" :value="old('nama_subkategori')" required />
                    <x-label for="kategori_id_kategori">{{ __('Kategori') }} </x-label>
                    <select name="kategori_id_kategori" id="kategori_id_kategori" class="rounded-md border-gray-300 block w-full">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
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
