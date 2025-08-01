@extends('dashboard.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="card p-8">

        <div class="space-y-2">
            <p class="text-lg text-gray-900 font-semibold">Selamat Datang, <span
                    class="font-bold">{{ auth()->user()->name }}</span></p>
            <p class="text-sm text-black">Email : {{ auth()->user()->email }}</p>
        </div>

        <div class="space-y-2 w-1/2 mt-10">
            <p class="text-lg text-black font-semibold">Pintasan</p>
            <div class="grid grid-cols-2 gap-4">
                @if (auth()->user()->role == 'opd')
                    <a href="{{ route('penilaian.index') }}"
                        class="p-4 bg-blue-600 border border-blue-700 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 shadow-md">
                        <i class="fad fa-tasks text-white"></i>
                        <p class="font-semibold text-white">Penilaian Mandiri</p>
                    </a>
                    <a href="{{ route('pembinaan.index') }}"
                        class="p-4 bg-green-600 border border-green-700 rounded-lg hover:bg-green-700 transition flex items-center gap-2 shadow-md">
                        <i class="fad fa-whistle text-white"></i>
                        <p class="font-semibold text-white">Pembinaan</p>
                    </a>
                @elseif (auth()->user()->role == 'walidata')
                    <a href="{{ route('disposisi.penilaian.tersedia') }}"
                        class="p-4 bg-yellow-600 border border-yellow-700 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2 shadow-md">
                        <i class="fad fa-check-circle text-white"></i>
                        <p class="font-semibold text-white">Penilaian Selesai</p>
                    </a>
                    <a href="{{ route('pembinaan.index') }}"
                        class="p-4 bg-green-600 border border-green-700 rounded-lg hover:bg-green-700 transition flex items-center gap-2 shadow-md">
                        <i class="fad fa-whistle text-white"></i>
                        <p class="font-semibold text-white">Pembinaan</p>
                    </a>
                @elseif (auth()->user()->role == 'admin')
                    <a href="{{ route('disposisi.penilaian.tersedia') }}"
                        class="p-4 bg-yellow-600 border border-yellow-700 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2 shadow-md">
                        <i class="fad fa-check-circle text-white"></i>
                        <p class="font-semibold text-white">Penilaian Selesai</p>
                    </a>
                    <a href="{{ route('dokumentasi.index') }}"
                        class="p-4 bg-purple-600 border border-purple-700 rounded-lg hover:bg-purple-700 transition flex items-center gap-2 shadow-md">
                        <i class="fad fa-camera text-white"></i>
                        <p class="font-semibold text-white">Dokumentasi</p>
                    </a>
                @endif
            </div>
        </div>


    </div>


    <div class="card mt-8 ">
        <div class="max-w-xxl border-indigo-500 mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Generate Penilaian</h2>
            <form action="{{ route('dashboard.generate-penilaian') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih User</label>
                    <select name="user_id" id="user_id" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" selected>-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kegiatan
                        Kegiatan</label>
                    <select name="formulir_id" id="formulir_id" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" selected>-- Pilih Kegiatan Penilaian --</option>
                        @foreach ($kegiatanPenilaian as $penilaian)
                            <option value="{{ $penilaian->id }}">{{ $penilaian->nama_formulir }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="flex justify-end space-x-2">
                    <a href="{{ url()->previous() }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Generate</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="card mt-8 ">
        <div class="max-w-xxl border-indigo-500 mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Generate EPSS</h2>
            <p class="text-sm text-gray-">
                Form ini akan menggenerate Domain, Aspek dan Indikator sesuai dengan standart EPSS yang telah diberikan oleh BPS.
            </p>

            <div class="flex justify-end space-x-2">
                <a href="{{ url()->previous() }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Generate</button>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
@endpush
