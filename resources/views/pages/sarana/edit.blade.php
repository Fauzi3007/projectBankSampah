<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{route('sarana.update',$sarana->id_sarana)}}" method="post" class="grid grid-cols-2 gap-6 mt-2">
            @method('PUT')
              @csrf
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
  
                <x-label for="nama_sarana">{{ __('Nama Sarana') }} </x-label>
                <x-input id="nama_sarana" type="text" name="nama_sarana" :value="old('nama_sarana', $sarana->nama_sarana)"
                    required />
  
                <x-label for="alamat_sarana">{{ __('Alamat Sarana') }} </x-label>
                <x-input id="alamat_sarana" type="text"  name="alamat_sarana" :value="old('alamat_sarana',$sarana->alamat_sarana)" required />
  
                <x-label for="jenis_sarana">{{ __('Jenis Sarana') }} </x-label>
                <x-input id="jenis_sarana" type="text" name="jenis_sarana" :value="old('jenis_sarana',$sarana->jenis_sarana)" required />
                  
                <x-label for="mitra">{{ __('Mitra') }} </x-label>
                 <select id="mitra" name="mitra" required class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                      <option value="" disabled selected>Select an option</option>
                  @foreach($mitras as $mitra)
                      <option value="{{ $mitra->id_mitra }}" {{$sarana->mitra_id_mitra == $mitra->id_mitra ? 'selected' : ''}}>{{ $mitra->nama_admin }}</option>
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
  