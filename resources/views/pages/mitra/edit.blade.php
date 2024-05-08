<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{route('mitra.update',$mitra->id_mitra)}}" method="post" class="grid grid-cols-2 gap-6 mt-2">
            @method('PUT')
              @csrf
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
  
                <x-label for="nama_admin">{{ __('Nama Admin') }} </x-label>
                <x-input id="nama_admin" type="text" name="nama_admin" :value="old('nama_admin', $mitra->nama_admin)"
                    required />
  
                <x-label for="no_hp">{{ __('Nomor Telepon') }} </x-label>
                <x-input id="no_hp" type="text"  name="no_hp" :value="old('no_hp',$mitra->no_hp)" required />
  
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
  