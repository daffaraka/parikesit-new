@extends('dashboard.layout')
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

@section('title', 'Dokumentasi Kegiatan ' . $dokumentasiKegiatan->nama_formulir)

@section('content')
    <div class="space-y-6">

        {{-- Judul --}}
        <div class="flex justify-between items-center">
            <h4 class="text-xl font-semibold text-gray-700">DOKUMENTASI</h4>
        </div>



        <nav class="bg-white p-4 border-2 rounded-md w-full mb-4">
            <ol class="list-reset flex text-grey-dark">

                <li><a href="{{ route('dokumentasi.index') }}" class="text-blue-600 hover:underline">Dokumentasi</a></li>
                <li><span class="mx-2">&gt;</span></li>
                <li class="text-gray-700">Kegiatan : {{ $dokumentasiKegiatan->judul_dokumentasi }}</li>
            </ol>
        </nav>


        {{-- Informasi Tahapan dan Kegiatan --}}

        <div class="grid grid-cols-4 md:grid-cols-1 gap-4">
            <!-- Box Kiri -->
            <div class="col-span-4 border-2 border-blue-400 bg-white p-4 rounded-md shadow-sm">
                {{-- <div class="text-md text-blue-600 font-bold mb-4">Nama Dokumentasi</div> --}}
                {{-- <div class="text-sm text-blue-700 mb-3">Penilaian Mandiri (1 April 2024 – 31 April 2024)</div> --}}
                {{-- <div class="text-xs text-gray-500 mb-3">Berakhir dalam 4 hari 5 jam 49 menit 24 detik</div> --}}
                <div class="border rounded-md p-3 bg-blue-50">
                    {{-- <div class="font-medium text-gray-700 mb-1">Kegiatan Statistik</div> --}}
                    <div class="flex justify-between">
                        <div class="">
                            <div class="text-2xl underline text-gray-800">
                                <div class="font-bold inline">
                                    {{ $dokumentasiKegiatan->judul_dokumentasi }}
                                </div>
                            </div>
                            <div class="text-sm text-blue-600  mt-2">
                                {{ $dokumentasiKegiatan->created_at->format('d F Y') }} |
                                {{ $dokumentasiKegiatan->instansi ?? 'Dinas Lorem Ipsum' }}</div>

                        </div>


                    </div>





                </div>


            </div>

            <div class="col-span-4">
                <div class="flex gap-5">
                    <div class="w-1/2">
                        <a href="{{ route('dokumentasi.edit', $dokumentasiKegiatan->id) }}"
                            class="w-full text-center block bg-indigo-800 text-white px-4 py-2 rounded hover:bg-gray-500 hover:text-black ">Edit</a>
                    </div>
                    <div class="w-1/2">
                        <form action="{{ route('dokumentasi.destroy', $dokumentasiKegiatan->id) }}" method="POST"
                            id="form_delete">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="deleteBtn w-full text-center block bg-red-700 text-white px-4 py-2 rounded hover:bg-red-900 hover:text-white">Hapus</button>
                        </form>
                    </div>
                </div>

            </div>




            <div class="col-span-4 border border-gray-300 bg-white p-4 rounded-md shadow-sm">
                <div class="text-md font-bold text-gray-800 mb-4">Dokumen Terkait</div>

                <div class="grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-1 md:grid-cols-1 gap-4">
                    <!-- Item 1: PDF Undangan -->
                    <div class="flex items-center justify-between p-4 border rounded-md bg-white shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-500 text-xl mr-3"></i>
                            <div>
                                <div class="font-semibold text-sm text-gray-800">PDF Undangan</div>
                                {{-- <div class="text-xs text-gray-600 truncate">undangan_penilaian_mandiri.pdf</div> --}}
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $dokumentasiKegiatan->bukti_dukung_undangan_dokumentasi) }}"
                            class="flex items-center text-gray-700 hover:text-black text-sm">
                            <i class="fas fa-download mr-1"></i> Download
                        </a>
                    </div>

                    <!-- Item 2: PDF Daftar Hadir -->
                    <div class="flex items-center justify-between p-4 border rounded-md bg-white shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-users text-green-600 text-xl mr-3"></i>
                            <div>
                                <div class="font-semibold text-sm text-gray-800">PDF Daftar Hadir</div>
                                {{-- <div class="text-xs text-gray-600 truncate">daftar_hadir_april.pdf</div> --}}
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $dokumentasiKegiatan->daftar_hadir_dokumentasi) }}"
                            class="flex items-center text-gray-700 hover:text-black text-sm">
                            <i class="fas fa-download mr-1"></i> Download
                        </a>
                    </div>

                    <!-- Item 3: PDF Notula -->
                    <div class="flex items-center justify-between p-4 border rounded-md bg-white shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-orange-500 text-xl mr-3"></i>
                            <div>
                                <div class="font-semibold text-sm text-gray-800">PDF Notula</div>
                                {{-- <div class="text-xs text-gray-600 truncate">notula_rapat_evaluasi.pdf</div> --}}
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $dokumentasiKegiatan->notula_dokumentasi) }}"
                            class="flex items-center text-gray-700 hover:text-black text-sm">
                            <i class="fas fa-download mr-1"></i> Download
                        </a>
                    </div>

                    <!-- Item 4: Media Gambar -->
                    {{-- <div class="flex items-center justify-between p-4 border rounded-md bg-white shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-image text-red-500 text-xl mr-3"></i>
                            <div>
                                <div class="font-semibold text-sm text-gray-800">Media Gambar</div>
                                <div class="text-xs text-gray-600 truncate">dokumentasi_kegiatan.jpg</div>
                            </div>
                        </div>
                        <a href="#" class="flex items-center text-gray-700 hover:text-black text-sm">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                    </div> --}}
                </div>
            </div>

        </div>






        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 sm:grid-cols-1 gap-4">
            <div class="bg-gray-100 min-h-100 w-100 p-5 border border-gray-500 rounded">
                <div class="font-semibold text-gray-700 mb-2">Media</div>



                <div id="controls-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-100 overflow-hidden rounded-lg md:h-96">

                        @foreach ($dokumentasiKegiatan->file_dokumentasi as $index => $media)
                            <div class="hidden duration-700 ease-in-out"
                                data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $media->nama_file) }}"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">
                            </div>
                        @endforeach


                    </div>
                    <!-- Slider indicators -->

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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

            </div>

        </div>

        <div class="mt-4">
            <a href="{{ url()->previous() }}"
                class="bg-indigo-800 text-white px-4 py-4 rounded hover:bg-gray-500 hover:text-black">Kembali</a>
        </div>



        {{-- Tabel Nilai IPS --}}

    </div>
@endsection

@push('scripts')
    <script>
        $('.deleteBtn').click(function(e) {

            var id = $(this).data('id');

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak dapat mengembalikan formulir ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus formulir ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    $('#form_delete').submit();

                }
            })
        });
    </script>
@endpush
