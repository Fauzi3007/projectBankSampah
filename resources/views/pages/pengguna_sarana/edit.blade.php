<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form action="{{ route('pengguna_sarana.update', $pengguna_sarana->id_pengguna_sarana) }}" method="post"
            class="grid grid-cols-2 gap-6 mt-2">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <x-label for="nama_pengguna">{{ __('Nama Pengguna') }} </x-label>
                <x-input id="nama_pengguna" type="text" name="nama_pengguna" :value="old('nama_pengguna', $pengguna_sarana->nama_pengguna)" required />

                <x-label for="no_hp">{{ __('Nomor Telepon') }} </x-label>
                <x-input id="no_hp" type="text" name="no_hp" :value="old('no_hp', $pengguna_sarana->no_hp)" required />

                <x-label for="email">{{ __('Email') }} </x-label>
                <x-input id="email" type="text" name="email" :value="old('email',$pengguna_sarana->user->email)" required />

                <x-label for="password">{{ __('Password') }} </x-label>
                <x-input id="password" type="password" name="password" required />

                <x-label for="password_confirmation">{{ __('Confirm Password') }} </x-label>
                <x-input id="password_confirmation" type="password" name="password_confirmation" required />

                <x-label for="role">{{ __('Role') }} </x-label>
                <select name="role" id="role"
                    class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="admin" @if($pengguna_sarana->user->role == 'admin') selected @endif>Admin</option>
                    <option value="pengguna" @if($pengguna_sarana->user->role == 'pengguna') selected @endif>Pengguna</option>
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
