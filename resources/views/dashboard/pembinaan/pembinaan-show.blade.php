@extends('dashboard.layout')
@section('content')
    <div class="card mt-6 p-8 border border-indigo-400">
        <h4 class="h4 mb-4">Detail Penjadwalan</h4>
        <hr>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Nama Pemateri</label>
                <p class="text-gray-800 ">{{ $penjadwalan->nama_pemateri }}</p>
            </div>
            <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Judul Jadwal</label>
                <p class="text-gray-800 ">{{ $penjadwalan->judul_jadwal }}</p>
            </div>
            <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Tanggal Jadwal</label>
                <p class="text-gray-800 ">{{ $penjadwalan->tanggal_jadwal }}</p>
            </div>
            <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Waktu Mulai</label>
                <p class="text-gray-800 ">{{ $penjadwalan->waktu_mulai }}</p>
            </div>
            {{-- <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Pemateri Jadwal</label>
                <p class="p-2 rounded border">{{ $penjadwalan->pemateri_jadwal }}</p>
            </div> --}}
            <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Keterangan Jadwal</label>
                <p class="text-gray-800 ">{{ $penjadwalan->keterangan_jadwal }}</p>
            </div>
            <div class="flex flex-col gap my-3">
                <label class="font-semibold mb-2 block">Lokasi</label>
                <p class="text-gray-800 ">{{ $penjadwalan->lokasi }}</p>
            </div>
        </div>




    </div>

    <div class="card mt-6 p-8 border border-indigo-400">
        <h4 class="h4 mb-4">Penugasan Pembinaan Anda</h4>
        <hr>


        <form action="{{route('penjadwalan.pembinaan.store', ['penjadwalan'=> $penjadwalan])}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @if ($penjadwalan->peserta_pembinaan->count() > 0)
        @endif --}}
            <div
                class="px-4 py-2 w-20 text-center rounded-md border border-indigo-400 bg-blue-600 text-white mt-5 hover:bg-blue-800 hover:text-white ease-in-out transition duration-100">
                Cek</div>


            <div class="mt-5">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Ringkasan Pembinaan</label>

                <textarea rows="4" class="w-full border border-gray-700 rounded p-2 text-sm shadow " name="ringkasan_pembinaan"
                    placeholder="Beri ringkasan pembinaan yang telah anda ikuti"></textarea>
            </div>

            <!-- Bukti Dukung -->
            <div class="mt-5">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Bukti Pembinaan</label>
                <div class="text-xs text-gray-500 font-semibold mb-2">Unggah bukti dalam format JPG, JPEG, SVG maksimal 3 MB
                </div>
                <input type="file" name="bukti_pembinaan"
                    class="block w-full text-gray-700 rounded p-5 shadow border border-gray-700 text-sm mb-4" accept="image/*" />


            </div>


            <button type="submit"
                class="bg-indigo-500 p-3 w-full text-white mt-4 rounded-md hover:bg-indigo-600 transition duration-150 ease-in-out">Submit</button>


        </form>


    </div>
@endsection


@push('scripts')
@endpush
