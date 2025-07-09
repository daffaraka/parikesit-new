@extends('dashboard.layout')
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

@section('title', 'Dokumentasi Kegiatan ' . $formulir->nama_formulir)

@section('content')
    <div class="space-y-6">

        {{-- Judul --}}
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-semibold text-gray-700">DOKUMENTASI</h4>
        </div>



        <nav class="bg-white p-4 border-2 rounded-md w-full mb-4">
            <ol class="list-reset flex text-grey-dark">
                <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a></li>
                <li><span class="mx-2 ">&gt;</span></li>
                <li><a href="{{ route('dokumentasi.index') }}" class="text-blue-600 hover:underline">Dokumentasi</a></li>
                <li><span class="mx-2">&gt;</span></li>
                <li class="text-gray-700">Kegiatan : {{ $formulir->nama_formulir }}</li>
            </ol>
        </nav>


        {{-- Informasi Tahapan dan Kegiatan --}}
        <div class="grid grid-cols-2 md:grid-cols-1 gap-4">
            <!-- Box Kiri -->
            <div class="col-span-1 border-2 border-blue-400 bg-white p-4 rounded-md shadow-sm">
                <div class="text-md text-blue-600 font-bold mb-4">Tahapan saat ini</div>
                <div class="text-sm text-blue-700 mb-3">Penilaian Mandiri (1 April 2024 – 31 April 2024)</div>
                <div class="text-xs text-gray-500 mb-3">Berakhir dalam 4 hari 5 jam 49 menit 24 detik</div>
                <div class="border rounded-md p-3 bg-blue-50">
                    <div class="font-medium text-gray-700 mb-1">Kegiatan Statistik</div>
                    <div class="text-sm text-gray-800">Kegiatan : <div class="font-bold inline">
                            {{ $formulir->nama_formulir }}
                        </div>
                    </div>
                    <div class="text-sm text-blue-600 underline mt-2">
                        {{ $formulir->created_at->format('Y') }} | {{ $formulir->instansi ?? 'Dinas Lorem Ipsum' }}</div>
                </div>
            </div>

            <!-- Box Kanan -->
            <div class="border bg-white p-4 rounded-md shadow-sm">
                <div class="text-sm font-medium text-gray-700 mb-2">Tahapan berikutnya</div>
                <div class="text-sm text-indigo-600 mb-4">Penilaian Dokumen (1 April 2024 – 31 April 2024)</div>

                <div class="bg-indigo-100 p-3 rounded mb-4">
                    <div class="text-sm text-gray-700 font-medium mb-1">Progres Penilaian Mandiri</div>


                    <div class="my-4">

                        @php
                            if ($persentase <= 20 && $persentase > 0) {
                                $warna = 'bg-red-500';
                            } elseif ($persentase > 20 && $persentase <= 40) {
                                $warna = 'bg-yellow-500';
                            } elseif ($persentase > 40 && $persentase <= 60) {
                                $warna = 'bg-orange-500';
                            } elseif ($persentase > 60 && $persentase <= 80) {
                                $warna = 'bg-green-500';
                            } elseif ($persentase > 80 && $persentase <= 99) {
                                $warna = 'bg-blue-500';
                            } elseif ($persentase == 100) {
                                $warna = 'bg-indigo-500';
                            } else {
                                $warna = 'bg-gray-500';
                            }
                        @endphp



                        <div class="w-full bg-gray-200 rounded-full h-5">
                            <div class="h-5 rounded-full {{ $warna ?? 'bg-white' }}" style="width: {{ $persentase }}%">
                            </div>
                        </div>
                        <div class="px-1 mt-2">
                            <p class="mt-1 text-sm text-gray-700"> {{ $terisi }} dari {{ $totalIndikator }} indikator
                                <b class="font-weight-bolder">({{ $persentase }}%) </b>
                            </p>
                        </div>

                    </div>

                    {{-- <div class="text-xs text-gray-500">Indikator sudah lengkap</div> --}}
                </div>

            </div>
        </div>



        <div class="grid grid-cols-2 md:grid-cols-1 gap-4">
            <div class="bg-gray-100 min-h-100 w-100 p-5 border border-gray-500 rounded">
                <div class="font-semibold text-gray-700 mb-2">Dokumentasi</div>



                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-100 overflow-hidden rounded-lg rounded md:h-96">
                        <!-- Item 1 -->
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://picsum.photos/1200/600?random=1"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://picsum.photos/1200/600?random=2"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://picsum.photos/1200/600?random=3"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                        <!-- Item 4 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://picsum.photos/1200/600?random=4"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                        <!-- Item 5 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://picsum.photos/1200/600?random=5"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse ">
                        <button type="button" class="w-6 h-6 rounded-full border-4" aria-current="true"
                            aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-6 h-6 rounded-full border-2" aria-current="false"
                            aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-6 h-6 rounded-full border-2" aria-current="false"
                            aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        <button type="button" class="w-6 h-6 rounded-full border-2" aria-current="false"
                            aria-label="Slide 4" data-carousel-slide-to="3"></button>
                        <button type="button" class="w-6 h-6 rounded-full border-2" aria-current="false"
                            aria-label="Slide 5" data-carousel-slide-to="4"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

            </div>

        </div>



        {{-- Tabel Nilai IPS --}}

    </div>
@endsection

@push('scripts')
@endpush
