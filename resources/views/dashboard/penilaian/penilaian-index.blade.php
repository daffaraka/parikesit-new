@extends('dashboard.layout')
@section('content')
    <div class="card p-8">

        <div class="flex justify-between mb-4">
            <h4 class="h4">Kegiatan Penilaian</h4>


        </div>

        <hr class="my-4 border-t-2 border-gray-300">


        <div class="grid grid-cols-2 sm:grid-cols-1 md:grid-cols-1 gap-4">
            @foreach ($kegiatanPenilaian as $form)
                @php
                    $warna = match (true) {
                        $form->persentase >= 80 => 'bg-green-500',
                        $form->persentase >= 50 => 'bg-yellow-500',
                        $form->persentase > 0 => 'bg-red-500',
                        default => 'bg-gray-300',
                    };
                @endphp
                <div
                    class="bg-white border shadow-lg pb-1 mb-3 hover:bg-gray-300 transition ease-in-out duration-100 border-indigo-400 rounded-lg">
                    {{-- <h3>{{ $form->persentase }}</h3> --}}
                    <div class="w-full h-2 {{ $warna }} rounded-t-md "></div>

                    <div class="px-6 py-6">
                        <div class="flex items-center justify-between">
                            <h5 class="text-xl font-bold">{{ $form->nama_formulir }}</h5>


                            <p class="text-gray-800 text-md">
                                {{ \Carbon\Carbon::parse($form->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                            </p>



                        </div>
                        <div class="flex">
                            <ul class="list-disc pl-6 mt-2">
                                <li class="text-lg">
                                    <p class="font-semibold text-blue-700">{{ $form->domain->count() }} Aspek</p>
                                </li>
                                <li class="text-lg">
                                    <p class="font-semibold text-blue-700">
                                        {{ $form->domain->sum(function ($domain) {
                                            return $domain->aspek->count();
                                        }) }}
                                        Aspek</p>
                                </li>
                                <li class="text-lg">
                                    <p class="font-semibold text-blue-700">
                                        {{ $form->domain->sum(function ($domain) {
                                            return $domain->aspek->sum(function ($aspek) {
                                                return $aspek->indikator->count();
                                            });
                                        }) }}
                                        Indikator </p>
                                </li>
                            </ul>
                        </div>
                        <div class="flex justify-end mt-4 gap-3">
                            <a href="{{ route('formulir.penilaianTersedia', ['formulir' => $form->id]) }}"
                                class="py-1 px-4 text-small bg-gray-900 rounded shadow-md text-white hover:text-blue-100 hover:bg-gray-800 transform duration-100 ease-in-out">
                                <i class="fad fa-edit mr-2"></i> Lakukan Penilaian</a>


                        </div>
                    </div>


                </div>
            @endforeach
        </div>

    </div>
@endsection
@push('scripts')
@endpush
