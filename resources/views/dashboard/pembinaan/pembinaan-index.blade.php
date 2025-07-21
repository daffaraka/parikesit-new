@extends('dashboard.layout')
@section('content')
    <div class="flex justify-between mb-4">
        <div class="">
            <h4 class="h4">Pembinaan</h4>

        </div>
        <a href="{{ route('pembinaan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded shadow">+
            Tambah
            Pembinaan</a>

    </div>

    {{-- <hr class="my-4 border-t-2 border-gray-300"> --}}

    <div class="mb-6">
        <ul class="flex space-x-4">
            <li>
                <button class="tab-button font-semibold text-sm py-2 px-4 rounded bg-blue-100 text-blue-800 active">Akan
                    Datang</button>
            </li>
            <li>
                <button class="tab-button font-semibold text-sm py-2 px-4 rounded hover:bg-gray-200">Sedang
                    Berlangsung</button>
            </li>
            <li>
                <button class="tab-button font-semibold text-sm py-2 px-4 rounded hover:bg-gray-200">Selesai</button>
            </li>
            <li>
                <button class="tab-button font-semibold text-sm py-2 px-4 rounded hover:bg-gray-200">Semua</button>
            </li>
        </ul>
    </div>

    <div class="pembinaan-belum-selesai">
        <h2 class="text-lg font-semibold mb-4">Pembinaan Belum Selesai</h2>
        <div class="grid grid-cols-3 lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 gap-6">


            @foreach ($pembinaanBelumSelesai as $pembinaan)
                <div class="col-span-1">
                    <div class="border rounded-lg shadow bg-white">
                        <div class="h-4 w-full bg-orange-300 rounded-t-lg"></div>

                        <div class="p-6">
                            <div class="flex xl:flex md:flex-none justify-between">
                                <h2 class="text-lg font-semibold mb-2">{{ $pembinaan->judul_jadwal }}</h2>


                            </div>
                            <div class="text-sm text-gray-500 flex items-center mb-2">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M6 2a1 1 0 011 1v1h6V3a1 1 0 112 0v1h1a2 2 0 012 2v1H3V6a2 2 0 012-2h1V3a1 1 0 011-1zM3 9h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($pembinaan->tanggal_jadwal)->format('d M Y') }}
                            </div>

                            @php
                                $now = \Carbon\Carbon::now();
                                $jadwal = \Carbon\Carbon::parse($pembinaan->tanggal_jadwal);
                                $style = 'bg-yellow-200 text-yellow-800';
                                if ($jadwal->isFuture()) {
                                    $style = 'bg-blue-200 text-blue-800';
                                } elseif ($jadwal->isToday()) {
                                    $style = 'bg-green-200 text-green-800';
                                } elseif ($jadwal->isPast()) {
                                    $style = 'bg-red-200 text-red-800';
                                }
                            @endphp

                            <span class="inline-block {{ $style }} text-xs px-3 py-1 rounded mb-3">
                                {{ $jadwal->isFuture() ? 'Akan Datang' : ($jadwal->isToday() ? 'Berlangsung Hari Ini' : 'Terlewat') }}
                            </span>
                            <p class="text-sm text-gray-700 mb-3">{{ Str::limit($pembinaan->keterangan_jadwal, 100) }}</p>
                            <div class="text-sm text-gray-600 mb-1"><strong>Peserta:</strong>
                                {{ $pembinaan->peserta_pembinaan->count() ?? 'N/A' }} orang</div>
                            <div class="text-sm text-gray-600 mb-1"><strong>Lokasi:</strong> {{ $pembinaan->lokasi }}</div>
                            <div class="text-sm text-gray-600 mb-4"><strong>Penyelenggara:</strong>
                                {{ $pembinaan->penyelenggara ?? 'BPS' }}</div>
                            <div class="flex space-x-2">
                                {{-- <a href="#" class="bg-gray-800 text-white text-sm px-4 py-2 rounded hover:bg-gray-600">Materi</a> --}}
                                <a href="{{ route('penjadwalan.show', $pembinaan->id) }}"
                                    class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-800">Detail</a>

                                <a href="{{ route('penjadwalan.pembinaan.show', $pembinaan->id) }}"
                                    class="border border-green-600 text-green-600 text-sm px-4 py-2 rounded hover:bg-green-500 hover:text-white">Selesaikan
                                    Penugasan</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach



        </div>

    </div>


    <div class="grid grid-cols-3 lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 gap-6 mt-8">


        <div class="col-span-2">
            <h2 class="text-lg font-semibold mb-4">Pembinaan Sudah Selesai</h2>
            @foreach ($pembinaanSelesai as $pembinaan)
                <div class="border rounded-lg shadow p-6 bg-white">

                    <div class="flex xl:flex md:flex-none justify-between">
                        <h2 class="text-lg font-semibold mb-2">{{ $pembinaan->judul_jadwal }}</h2>


                    </div>
                    <div class="text-sm text-gray-500 flex items-center mb-2">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M6 2a1 1 0 011 1v1h6V3a1 1 0 112 0v1h1a2 2 0 012 2v1H3V6a2 2 0 012-2h1V3a1 1 0 011-1zM3 9h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($pembinaan->tanggal_jadwal)->format('d M Y') }}
                    </div>

                    @php
                        $now = \Carbon\Carbon::now();
                        $jadwal = \Carbon\Carbon::parse($pembinaan->tanggal_jadwal);
                        $style = 'bg-yellow-200 text-yellow-800';
                        if ($jadwal->isFuture()) {
                            $style = 'bg-blue-200 text-blue-800';
                        } elseif ($jadwal->isToday()) {
                            $style = 'bg-green-200 text-green-800';
                        } elseif ($jadwal->isPast()) {
                            $style = 'bg-red-200 text-red-800';
                        }
                    @endphp

                    <span class="inline-block {{ $style }} text-xs px-3 py-1 rounded mb-3">
                        {{ $jadwal->isFuture() ? 'Akan Datang' : ($jadwal->isToday() ? 'Berlangsung Hari Ini' : 'Terlewat') }}
                    </span>
                    <p class="text-sm text-gray-700 mb-3">{{ Str::limit($pembinaan->keterangan_jadwal, 100) }}</p>
                    <div class="text-sm text-gray-600 mb-1"><strong>Peserta:</strong>
                        {{ $pembinaan->peserta_pembinaan->count() ?? 'N/A' }} orang</div>
                    <div class="text-sm text-gray-600 mb-1"><strong>Lokasi:</strong> {{ $pembinaan->lokasi }}</div>
                    <div class="text-sm text-gray-600 mb-4"><strong>Penyelenggara:</strong>
                        {{ $pembinaan->penyelenggara ?? 'BPS' }}</div>
                    <div class="flex space-x-2">
                        {{-- <a href="#" class="bg-gray-800 text-white text-sm px-4 py-2 rounded hover:bg-gray-600">Materi</a> --}}
                        <a href="{{ route('penjadwalan.show', $pembinaan->id) }}"
                            class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-800">Detail</a>

                        <a href="{{ route('penjadwalan.show', $pembinaan->id) }}"
                            class="border border-green-600 text-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-500 hover:text-white">Penugasan</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.deleteBtn').click(function(e) {

            var id = $(this).data('id');

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak dapat mengembalikan pembinaan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus pembinaan ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    $('#form_delete').submit();

                }
            })
        });
    </script>
@endpush
