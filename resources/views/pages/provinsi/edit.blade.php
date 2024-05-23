<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{route('provinsi.update',$provinsis->id_provinsi)}}" method="post" class="grid grid-cols-2 gap-6 mt-2">
            @method('PUT')
              @csrf
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <x-label for="nama_provinsi">{{ __('Nama Provinsi') }} </x-label>
                <x-input id="nama_provinsi" type="text" name="nama_provinsi" :value="old('nama_provinsi',$provinsis->nama_provinsi)"
                    required />
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
