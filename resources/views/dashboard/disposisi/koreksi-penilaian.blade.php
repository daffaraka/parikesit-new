@extends('dashboard.layout')
@section('title', 'Penilaian Indikator ' . $indikator->nama_indikator)
@section('content')
    <div class="flex justify-between items-center">
        <h4 class="text-lg font-semibold text-blue-700 text-uppercase mb-3">Aspek {{ strtoupper($aspek->nama_aspek) }}</h4>
    </div>

    <nav class="bg-white p-4 border-2 rounded-md w-full mb-4">
        <ol class="list-reset flex text-grey-dark">

            <li><a href="{{ route('disposisi.penilaian.tersedia') }}" class="text-blue-600 hover:underline">Koreksi
                    Penilaian</a></li>
            <li><span class="mx-2">&gt;</span></li>
            <li class="text-gray-700"> <a
                    href="{{ route('disposisi.penilaian.tersedia.detail', [$formulir->nama_formulir]) }}"
                    class="text-blue-600 hover:underline">Kegiatan Selesai : {{ $formulir->nama_formulir }} </a> </li>
            <li><span class="mx-2">&gt;</span></li>
            <li class="text-gray-700">
                <a href="{{ route('disposisi.koreksi.isi-domain', [$opd->name, $formulir->nama_formulir, $domain->nama_domain]) }}"
                    class="text-blue-600 hover:underline"> Domain Kegiatan : {{ $domain->nama_domain }} </a>
            </li>
            <li><span class="mx-2">&gt;</span></li>
            <li class="text-gray-700">
                Indikator {{ $indikator->nama_indikator }}
            </li>
        </ol>
    </nav>


    <div id="accordion-color" data-accordion="collapse"
        data-active-classes="bg-indigo-500 text-gray-100 rounded dark:bg-gray-800 dark:text-white"
        data-inactive-classes="text-white" class="my-5 rounded-md shadow-md">
        <h2 id="accordion-color-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right border-2 bg-black text-white border-indigo-100 border-b-0 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-700 dark:hover:bg-gray-800 hover:text-gray-100 gap-3"
                data-accordion-target="#accordion-color-body-1" aria-expanded="false"
                aria-controls="accordion-color-body-1">
                <span>Data Identitas Penilai</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-color-body-1" class="hidden bg-white" aria-labelledby="accordion-color-heading-1">
            <div class="p-5 border border-gray-200  dark:border-gray-700 dark:bg-gray-900">
                <table class="w-full border-2">
                    <tbody>
                        <tr>
                            <td
                                class="px-3 py-1 border-t border-b text-gray-100 border-gray-300 bg-gray-900 dark:border-gray-600 w-1/6">
                                Nama OPD</td>
                            <td class="px-3 py-1 border-t border-b border-gray-300 dark:border-gray-600 text-uppercase">
                                {{ $opd->name }}</td>
                        </tr>
                        <tr>
                            <td
                                class="px-3 py-1 border-t border-b text-gray-100 border-gray-300 bg-gray-900 dark:border-gray-600 w-1/6">
                                Jabatan</td>
                            <td class="px-3 py-1 border-t border-b border-gray-300 dark:border-gray-600 text-uppercase">
                                {{ $opd->role ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td
                                class="px-3 py-1 border-t border-b text-gray-100 border-gray-300 bg-gray-900 dark:border-gray-600 w-1/6">
                                Kontak</td>
                            <td class="px-3 py-1 border-t border-b border-gray-300 dark:border-gray-600 text-uppercase">
                                {{ $opd->nomor_telepon ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <div class="p-6 bg-white shadow rounded-md">
        <!-- Header -->
        <div class="flex justify-between items-center  pb-4">
            <div class="text-blue-600 font-semibold text-sm">Indikator {{ $indikator->nama_indikator }}</div>
            <div class="space-x-2">




                {{-- @if ($prev_indikator != null)
                    <a href="{{ route('formulir.penilaianAspek', [$formulir, $domain->nama_domain, $aspek->nama_aspek, $prev_indikator->nama_indikator]) }}"
                        class="text-blue-600 hover:text-blue-800">
                        ⬅️
                    </a>
                @endif

                  @if ($next_indikator != null)
                    <a href="{{ route('formulir.penilaianAspek', [$formulir, $domain->nama_domain, $aspek->nama_aspek, $next_indikator->nama_indikator]) }}"
                        class="text-blue-600 hover:text-blue-800">
                        ➡️
                    </a>
                @endif --}}
            </div>
        </div>


        <div class="grid grid-cols-2 gap-4">

            <!-- Kolom Kiri: Nilai & Bukti Dukung -->
            <div class="col-span-1 space-y-2">
                <!-- Nilai Dipilih -->
                <div class="border-2 bg-gray-100 border-blue-200 p-4 rounded-md">
                    <h1 class="text-blue-500 font-semibold text-md mb-2">Nilai Dipilih</h1>
                    <div class="bg-blue-700 py-3 text-center rounded-md shadow">
                        <p class="text-4xl font-bold text-gray-100">{{ $nilai_diinput->nilai ?? 0.0 }} / 5.00 </p>
                    </div>
                </div>

                <!-- Bukti Dukung -->

            </div>

            <div class="col-span-1 space-y-2">

                <div class="border-2 bg-gray-900 border-gray-200 p-4 rounded-md">
                    <h1 class="text-white font-semibold text-md mb-2">Nilai Koreksi</h1>
                    <div class="bg-indigo-500 py-3 text-center rounded-md shadow">
                        <p class="text-4xl font-bold text-gray-100">{{ $nilai_diinput->nilai_koreksi ?? '0.00' }} / 5.00
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-span-1 space-y-2">
                <div class="border-2 bg-gray-100 border-green-200 p-4 rounded-md h-full">
                    <h1 class="text-green-500 font-semibold text-md mb-2">Bukti Dukung Dilampirkan</h1>
                    <a href="{{ asset($nilai_diinput->bukti_dukung) }}" target="_blank"
                        class="flex items-center space-x-2 text-green-700 hover:underline">
                        <i class="fas fa-file-alt text-lg"></i>
                        <span>Lihat Bukti Dukung</span>
                    </a>
                </div>
            </div>

            <div class="col-span-1 space-y-2">
                <div class="border-2  border-yellow-400 p-4 rounded-md h-full">
                    <h1 class="text-yellow-500 font-semibold text-md mb-2">Catatan</h1>
                    <p class="text-md text-gray-900">
                        {{ $nilai_diinput->catatan ??
                            ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae totam ratione quis assumenda, saepe eligendi iusto sit mollitia velit perspiciatis nihil deserunt vero omnis cupiditate animi eius. Nesciunt, illum adipisci.
                                                                                                                                                                                                                        ' }}
                    </p>
                </div>

            </div>

            <!-- Kolom Kanan: Catatan -->


        </div>




        <div class="mt-24  border-indigo-200 border-2 rounded-md p-4">
            <h3 class="text-blue-600 font-semibold  ">Koreksi Penilaian</h3>
            {{-- <form action=""> --}}


            {{-- @if ($nilai_diinput)
                <a href="{{ route('formulir.isi-domain', [$formulir, $domain->nama_domain]) }}"
                    class="bg-gray-600 shadow hover:bg-gray-800 dark:hover:bg-gray-700  p-3 w-full text-white mt-4 rounded-md text-center">Kembali</a>
            @else --}}
            {{-- <div class="flex justify-between">
                    <button type="submit" class="bg-indigo-500 p-3 w-50 text-white mt-4 rounded-md">Simpan</button>
                </div> --}}
            {{-- @endif --}}

            {{-- </form> --}}

            {{-- @if (Auth::user()->role == 'walidata')
                @if ($nilai_diinput)

                    <form
                        action="{{ route('disposisi.koreksi.indikator.store-koreksi', [$formulir, $domain, $aspek, $indikator, $nilai_diinput->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div
                            class="md:flex md:items-center md:justify-between bg-yellow-50 p-4 rounded-md border border-yellow-300">
                            <div class="mb-5">
                                <div class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Status Pemeriksaan <b>(Khusus
                                        Walidata)</b>
                                </div>
                                <div>
                                    <select
                                        class="border border-indigo-400 shadow text-indigo-600 bg-white rounded-md px-3 py-2 text-sm">
                                        <option value="Disetujui">Disetujui</option>
                                        <option value="Tidak Disetujui">Tidak Disetujui</option>
                                    </select>
                                </div>
                            </div>


                            @if (Auth::user()->role != 'walidata')
                                <div class="mt-3 mb-2">
                                    <div class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Koreksi <b>(Khusus
                                            Walidata)</b>
                                    </div>
                                    <textarea rows="4" class="w-full border-2 border-gray-500 rounded p-2 text-sm" name="koreksi"
                                        placeholder="Koreksi dari Walidata..."></textarea>

                                </div>
                            @endif


                            <div class="space-y-2 text-sm">
                                <label for="level1_update"
                                    class="block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100">
                                    <div class="flex items-start space-x-3 ">
                                        <input type="radio" id="level1_update" name="nilai_update" value="1"
                                            class="mt-1 accent-blue-600">
                                        <span>Level 1. Rintisan:<br>SDS belum dilakukan oleh seluruh Produsen Data</span>
                                    </div>
                                </label>
                                <label for="level2_update"
                                    class="block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100">
                                    <div class="flex items-start space-x-3">
                                        <input type="radio" id="level2_update" name="nilai_update" value="2"
                                            class="mt-1 accent-blue-600">
                                        <span>Level 2. Terkelola:<br>Penerapan SDS telah dilakukan oleh setiap Produsen Data
                                            sesuai
                                            standar masing-masing</span>
                                    </div>
                                </label>
                                <label for="level3_update"
                                    class="block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100">
                                    <div class="flex items-start space-x-3 ">
                                        <input type="radio" id="level3_update" name="nilai_update" value="3"
                                            class="mt-1 accent-blue-600">
                                        <span>Level 3. Terdefinisi:<br>SDS dilakukan berdasarkan kaidah yang ditetapkan dan
                                            berlaku
                                            untuk seluruh Produsen Data</span>
                                    </div>
                                </label>
                                <label for="level4_update"
                                    class="block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100">
                                    <div class="flex items-start space-x-3">
                                        <input type="radio" id="level4_update" name="nilai_update" value="4"
                                            class="mt-1 accent-blue-600">
                                        <span>Level 4. Terpadu:<br>SDS dilakukan melalui reviu dan evaluasi berkala</span>
                                    </div>
                                </label>
                                <label for="level5_update"
                                    class="block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100">
                                    <div class="flex items-start space-x-3">
                                        <input type="radio" id="level5_update" name="nilai_update" value="5"
                                            class="mt-1 accent-blue-600">
                                        <span>Level 5. Optimum:<br>Pemutakhiran SDS dilakukan bersama Walidata</span>
                                    </div>
                                </label>
                            </div>
                            <button type="submit" class="bg-indigo-500 p-2 w-40 text-white mt-4 rounded-md">Beri
                                Koreksi</button>

                        </div>


                    </form>
                @endif
            @endif --}}

            <form
                action="{{ route('disposisi.koreksi.indikator.store-koreksi', [$formulir, $domain, $aspek, $indikator, $nilai_diinput->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-2 mt-5 font-semibold">

                    @php
                        $nilaiKoreksiTerkunci = $nilai_dikoreksi ? $nilai_dikoreksi->nilai_koreksi : null;
                        $style =
                            $nilaiKoreksiTerkunci == null
                                ? 'block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-indigo-200 ease-in-out transition duration-100'
                                : 'block bg-gray-300 border disabled rounded-md p-3 shadow-sm cursor-pointer';
                    @endphp

                    <input type="hidden" name="penilaian_id" value="{{ $nilai_diinput->id }}">
                    <div class="font-semibold text-sm text-gray-700">{{ $indikator->nama_indikator }}</div>
                    <div class="space-y-2 text-sm">
                        <label for="level1" class="{{ $style }}">
                            <div class="flex items-start space-x-3">
                                <input type="radio" id="level1" name="nilai" value="1"
                                    class="mt-1 accent-blue-600" {{ $nilaiKoreksiTerkunci == 1 ? 'checked' : '' }}
                                    {{ $nilaiKoreksiTerkunci !== null && $nilaiKoreksiTerkunci != 1 ? 'disabled' : '' }}>
                                <span>Level 1. Rintisan:<br>SDS belum dilakukan oleh seluruh Produsen Data</span>
                            </div>
                        </label>
                        <label for="level2" class="{{ $style }}">
                            <div class="flex items-start space-x-3">
                                <input type="radio" id="level2" name="nilai" value="2"
                                    class="mt-1 accent-blue-600" {{ $nilaiKoreksiTerkunci == 2 ? 'checked' : '' }}
                                    {{ $nilaiKoreksiTerkunci !== null && $nilaiKoreksiTerkunci != 2 ? 'disabled' : '' }}>
                                <span>Level 2. Terkelola:<br>Penerapan SDS telah dilakukan oleh setiap Produsen Data sesuai
                                    standar masing-masing</span>
                            </div>
                        </label>
                        <label for="level3" class="{{ $style }}">
                            <div class="flex items-start space-x-3">
                                <input type="radio" id="level3" name="nilai" value="3"
                                    class="mt-1 accent-blue-600" {{ $nilaiKoreksiTerkunci == 3 ? 'checked' : '' }}
                                    {{ $nilaiKoreksiTerkunci !== null && $nilaiKoreksiTerkunci != 3 ? 'disabled' : '' }}>
                                <span>Level 3. Terdefinisi:<br>SDS dilakukan berdasarkan kaidah yang ditetapkan dan berlaku
                                    untuk seluruh Produsen Data</span>
                            </div>
                        </label>
                        <label for="level4" class="{{ $style }}">
                            <div class="flex items-start space-x-3">
                                <input type="radio" id="level4" name="nilai" value="4"
                                    class="mt-1 accent-blue-600" {{ $nilaiKoreksiTerkunci == 4 ? 'checked' : '' }}
                                    {{ $nilaiKoreksiTerkunci !== null && $nilaiKoreksiTerkunci != 4 ? 'disabled' : '' }}>
                                <span>Level 4. Terpadu:<br>SDS dilakukan melalui reviu dan evaluasi berkala</span>
                            </div>
                        </label>
                        <label for="level5" class="{{ $style }}">
                            <div class="flex items-start space-x-3">
                                <input type="radio" id="level5" name="nilai" value="5"
                                    class="mt-1 accent-blue-600" {{ $nilaiKoreksiTerkunci == 5 ? 'checked' : '' }}
                                    {{ $nilaiKoreksiTerkunci !== null && $nilaiKoreksiTerkunci != 5 ? 'disabled' : '' }}>
                                <span>Level 5. Optimum:<br>Pemutakhiran SDS dilakukan bersama Walidata</span>
                            </div>
                        </label>
                    </div>
                </div>




                <div class="mt-10">


                    @if ($nilai_diinput->nilai_koreksi != null)
                        <a href="{{ route('disposisi.koreksi.isi-domain', [$opd->name, $formulir->nama_formulir, $domain->nama_domain]) }}"
                            class="bg-gray-600 shadow hover:bg-gray-800 dark:hover:bg-gray-700  p-3 w-full text-white mt-4 rounded-md text-center">Kembali</a>
                    @else
                        <div class="flex justify-between">
                            <button type="submit"
                                class="bg-indigo-500 p-3 w-50 text-white mt-4 rounded-md">Koreksi</button>

                            <a href="{{ route('disposisi.koreksi.isi-domain', [$opd->name, $formulir->nama_formulir, $domain->nama_domain]) }}"
                                class="bg-gray-600 shadow hover:bg-gray-800 dark:hover:bg-gray-700  p-3 text-white mt-4 rounded-md text-center">Kembali</a>
                        </div>
                    @endif

                </div>


            </form>
        </div>



        <!-- Status Pemeriksaan -->



    </div>

@endsection
@push('scripts')
    <script>
        $(function() {
            const radios = $('input[name="nilai"]');

            function updateSelectedBackground() {
                radios.each(function() {
                    const label = $(`label[for="${this.id}"]`);
                    if (this.checked) {
                        label.addClass('bg-indigo-400');
                    } else {
                        label.removeClass('bg-indigo-400');
                    }
                });
            }

            // Jalankan saat load halaman untuk menyetel nilai yang tersimpan
            updateSelectedBackground();

            // Tambahkan event saat diklik
            radios.on('change', updateSelectedBackground);
        });
    </script>
@endpush
