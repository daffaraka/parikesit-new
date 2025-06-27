@extends('dashboard.layout')

@section('content')
    <div class="flex justify-between items-center">
        <h4 class="text-lg font-semibold text-blue-700 text-uppercase mb-3">Aspek {{ strtoupper($aspek->nama_aspek) }}</h4>
    </div>

    <div class="p-6 bg-white shadow rounded-md space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4">
            <div class="text-blue-600 font-semibold text-sm">Indikator {{ $indikator->nama_indikator }}</div>
            <div class="space-x-2">
                <button title="Penjelasan" class="text-yellow-500 hover:text-yellow-600">
                    💡
                </button>
                <button title="Indikator selanjutnya" class="text-blue-600 hover:text-blue-800">
                    ➡️
                </button>
            </div>
        </div>

        <form action="{{ route('formulir.store-penilaian', [$formulir, $domain, $aspek, $indikator]) }}" method="POST">
            @csrf
            <!-- Status Pemeriksaan -->
            <div class="md:flex md:items-center md:justify-between bg-yellow-50 p-4 rounded-md border border-yellow-300">
                <div class="text-sm font-medium text-gray-700 mb-2 md:mb-0">Status Pemeriksaan</div>
                <div>
                    <select class="border border-red-400 text-red-600 bg-white rounded-md px-3 py-2 text-sm">
                        <option selected>Menunggu Pemeriksaan</option>
                        <option>Disetujui</option>
                        <option>Revisi</option>
                    </select>
                </div>
            </div>

            <!-- Tingkat Kematangan -->
            <div class="space-y-2 mt-5 font-semibold">

                @php
                    $nilaiTerkunci = $dinilai ? $dinilai->penilaian->first()->nilai : null;
                    $style =
                        $nilaiTerkunci == null
                            ? 'block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100'
                            : 'block bg-gray-300 border disabled rounded-md p-3 shadow-sm cursor-pointer';
                @endphp

                    {{$nilaiTerkunci ?? 'gk'}}
                <div class="font-semibold text-sm text-gray-700">{{ $indikator->nama_indikator }}</div>
                <div class="space-y-2 text-sm">
                    <label for="level1" class="{{ $style }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level1" name="nilai" value="1" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 1 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 1 ? 'disabled' : '' }}>
                            <span>Level 1. Rintisan:<br>SDS belum dilakukan oleh seluruh Produsen Data</span>
                        </div>
                    </label>
                    <label for="level2" class="{{ $style }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level2" name="nilai" value="2" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 2 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 2 ? 'disabled' : '' }}>
                            <span>Level 2. Terkelola:<br>Penerapan SDS telah dilakukan oleh setiap Produsen Data sesuai
                                standar masing-masing</span>
                        </div>
                    </label>
                    <label for="level3" class="{{ $style }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level3" name="nilai" value="3" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 3 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 3 ? 'disabled' : '' }}>
                            <span>Level 3. Terdefinisi:<br>SDS dilakukan berdasarkan kaidah yang ditetapkan dan berlaku
                                untuk seluruh Produsen Data</span>
                        </div>
                    </label>
                    <label for="level4" class="{{ $style }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level4" name="nilai" value="4" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 4 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 4 ? 'disabled' : '' }}>
                            <span>Level 4. Terpadu:<br>SDS dilakukan melalui reviu dan evaluasi berkala</span>
                        </div>
                    </label>
                    <label for="level5" class="{{ $style }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level5" name="nilai" value="5" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 5 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 5 ? 'disabled' : '' }}>
                            <span>Level 5. Optimum:<br>Pemutakhiran SDS dilakukan bersama Walidata</span>
                        </div>
                    </label>
                </div>
            </div>


            {{-- <div class="space-y-2 mt-5 font-semibold">

                @php
                    $nilaiTerkunci = $dinilai ? $dinilai->penilaian->first()->nilai : null;
                    $activeHover =
                        'block bg-white border rounded-md p-3 shadow-sm cursor-pointer hover:bg-blue-200 ease-in-out transition duration-100';
                    $disabled = 'block bg-gray-300 border  rounded-md p-3 shadow-sm cursor-pointer';
                @endphp
                <h3>{{ $nilaiTerkunci == null }}</h3>

                <div class="font-semibold text-sm text-gray-700">{{ $indikator->nama_indikator }}</div>
                <div class="space-y-2 text-sm">
                    <label for="level1" class="{{ $nilaiTerkunci == 1 ? $activeHover : $disabled }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level1" name="nilai" value="1" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 1 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 1 ? 'disabled' : '' }}>
                            <span>Level 1. Rintisan:<br>SDS belum dilakukan oleh seluruh Produsen Data</span>
                        </div>
                    </label>
                    <label for="level2" class="{{ $nilaiTerkunci == 2 ? $activeHover : $disabled }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level2" name="nilai" value="2" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 2 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 2 ? 'disabled' : '' }}>
                            <span>Level 2. Terkelola:<br>Penerapan SDS telah dilakukan oleh setiap Produsen Data sesuai
                                standar masing-masing</span>
                        </div>
                    </label>
                    <label for="level3" class="{{ $nilaiTerkunci == 3 ? $activeHover : $disabled }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level3" name="nilai" value="3" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 3 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 3 ? 'disabled' : '' }}>
                            <span>Level 3. Terdefinisi:<br>SDS dilakukan berdasarkan kaidah yang ditetapkan dan berlaku
                                untuk seluruh Produsen Data</span>
                        </div>
                    </label>
                    <label for="level4" class="{{ $nilaiTerkunci == 4 ? $activeHover : $disabled }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level4" name="nilai" value="4" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 4 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 4 ? 'disabled' : '' }}>
                            <span>Level 4. Terpadu:<br>SDS dilakukan melalui reviu dan evaluasi berkala</span>
                        </div>
                    </label>
                    <label for="level5" class="{{ $nilaiTerkunci == 5 ? $activeHover : $disabled }}">
                        <div class="flex items-start space-x-3">
                            <input type="radio" id="level5" name="nilai" value="5" class="mt-1 accent-blue-600"
                                {{ $nilaiTerkunci == 5 ? 'checked' : '' }}
                                {{ $nilaiTerkunci !== null && $nilaiTerkunci != 5 ? 'disabled' : '' }}>
                            <span>Level 5. Optimum:<br>Pemutakhiran SDS dilakukan bersama Walidata</span>
                        </div>
                    </label>
                </div>
            </div> --}}



            <!-- Penjelasan -->
            <div class="mt-5">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Penjelasan</label>

                @if ($dinilai)
                    <textarea rows="4" class="w-full border rounded p-2 text-sm" name="penjelasan" disabled>{{ $dinilai->penilaian->first()->catatan }} </textarea>
                @else
                    <textarea rows="4" class="w-full border rounded p-2 text-sm" name="penjelasan"
                        placeholder="Penjelasan indikator..."></textarea>
                @endif
            </div>

            <!-- Bukti Dukung -->
            <div class="mt-5">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Bukti Dukung</label>
                <div class="text-xs text-gray-500 mb-2">Unggah bukti dalam format .pdf maksimal 3 MB</div>
                <input type="file" name="bukti_dukung"
                    class="block w-full text-gray-700 rounded p-5 shadow border-2 text-sm mb-4" />


            </div>


            <button type="submit" class="bg-indigo-500 p-3 w-full text-white mt-4 rounded-md">Simpan</button>


        </form>

    </div>
    {{-- <table class="w-full text-sm border">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="border px-2 py-1">No.</th>
                            <th class="border px-2 py-1">Nama Berkas</th>
                            <th class="border px-2 py-1">Aksi</th>
                            <th class="border px-2 py-1">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                    <td class="border px-2 py-1 text-center">1</td>
                    <td class="border px-2 py-1">Bukti dukung 1.pdf</td>
                    <td class="border px-2 py-1 space-x-2">
                        <a href="#" class="text-blue-600 hover:underline">Lihat</a>
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </td>
                    <td class="border px-2 py-1">Penilaian Mandiri - Operator</td>
                </tr>
                    </tbody>
                </table> --}}
@endsection
@push('scripts')
    <script>
        $(function() {
            const radios = $('input[name="nilai"]');

            function updateSelectedBackground() {
                radios.each(function() {
                    const label = $(`label[for="${this.id}"]`);
                    if (this.checked) {
                        label.addClass('bg-blue-200');
                    } else {
                        label.removeClass('bg-blue-200');
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
