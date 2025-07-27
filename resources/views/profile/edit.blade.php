@extends('dashboard.layout')
@section('title', 'Edit Profile')
@section('content')
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Profile') }}
</h2>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Informasi Profil') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Perbarui informasi profil akun Anda.") }}
                        </p>
                    </header>

                    <form action="{{ route('profile.update') }}" method="POST" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Name') }}
                            </label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none sm:text-sm"
                                    required autofocus autocomplete="name" />
                            </div>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Email') }}
                            </label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none sm:text-sm"
                                    required autocomplete="username" />
                            </div>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </p>

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                        {{ __('Alamat email Anda belum diverifikasi.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                            {{ __('Klik di sini untuk mengirimkan ulang email verifikasi.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email Anda.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Password') }}
                            </label>
                            <div class="mt-1">
                                <input type="password" name="password" id="password" autocomplete="new-password"
                                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none sm:text-sm"
                                    required />
                            </div>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Alamat') }}
                            </label>
                            <div class="mt-1">
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}"
                                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none sm:text-sm"
                                    required />
                            </div>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                           <div>
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Nomor Telephone') }}
                            </label>
                            <div class="mt-1">
                                <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}"
                                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none sm:text-sm"
                                    required />
                            </div>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                @error('nomor_telepon')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Simpan') }}
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Tersimpan.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>

            </div>
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div> --}}
    </div>
</div>
@endsection
@push('scripts')

@endpush