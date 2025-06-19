@extends('dashboard.layout')

@section('content')
    {{-- formulir/{id-domain}/domain-penilaian/{domain} --}}
    <div class="space-y-6">

        {{-- Judul --}}
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-semibold text-blue-700 text-uppercase">{{ strtoupper($domain->nama_domain) }}</h4>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
            @foreach ($domain->aspek as $aspek)
                <div
                    class="bg-white border border-gray-300 shadow-lg rounded-md hover:bg-gray-100 transition ease-in-out duration-100">

                    <div class="h-4 bg-gray-800 rounded-t-md"></div>
                    <div class="px-8 pt-6 pb-8">
                        <div class="flex items-center justify-between">
                            <h5 class="text-md font-bold text-blue-700">Aspek {{ $aspek->nama_aspek }}</h5>


                            <p class="text-gray-800 text-md">
                                {{ \Carbon\Carbon::parse($aspek->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                            </p>



                        </div>
                        <div class="flex bg-blue-100 rounded-md p-4 mt-4 shadow">

                            <table class="min-w-full table-fixed">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th
                                            class="w-1/2 px-6 py-3 text-left text-xs leading-4 font-bold text-gray-700 uppercase tracking-wider ">
                                            Indikator</th>
                                        <th
                                            class="w-1/5 px-6 py-3 text-left text-xs leading-4 font-bold text-gray-700 uppercase tracking-wider">
                                            Nilai</th>
                                        <th
                                            class="w-1/5 px-6 py-3 text-left text-xs leading-4 font-bold text-gray-700 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="w-1/3 px-6 py-3 text-left text-xs leading-4 font-bold text-gray-700 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($aspek->indikator as $indikator)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 truncate"
                                                title="{{ $indikator->nama_indikator }}">
                                                <a href="{{ route('formulir.penilaianAspek', [$formulir, $domain->nama_domain, $aspek->nama_aspek, $indikator->nama_indikator]) }}"
                                                    class="text-gray-800 font-semibold text-md ">
                                                    {{ Str::of($indikator->nama_indikator)->limit(60) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                @if ($indikator->penilaian->count())
                                                <span class="text-black rounded text-md font-bold"> {{ $indikator->penilaian->first()->nilai }}</span>


                                                @else
                                                    <span class="text-red-500">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                @if ($indikator->penilaian->count())
                                                    <span class="bg-blue-500 p-3 text-white rounded text-xs font-semibold">Sudah diisi</span>
                                                @else
                                                <span class="bg-red-500 p-3 text-white rounded text-xs font-semibold">Belum diisi</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <a href="{{ route('formulir.penilaianAspek', [$formulir, $domain->nama_domain, $aspek->nama_aspek, $indikator->nama_indikator]) }}"
                                                    class="text-blue-500 hover:text-blue-700 font-normal text-sm">
                                                    <i
                                                        class="fad fa-external-link-alt text-md mr-1 bg-green-500 text-white p-4 rounded ml-2"></i>

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- <div class="w-full">
                        <a href="{{route('formulir.sesiPenilaian',[$formulir, $domain])}}" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded w-full transition mt-4">Mulai Penilaian</a>
                    </div> --}}


                </div>
            @endforeach
        </div>

    </div>
@endsection

@push('scripts')
@endpush
