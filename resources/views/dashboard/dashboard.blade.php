@extends('dashboard.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="card p-8">

        <div class="flex justify-between mb-4">
            <h4 class="h4">Kegiatan Penilaian</h4>



            <!-- Modal -->


            <hr class="my-4 border-t-2 border-gray-300">




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
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kegiatan Kegiatan</label>
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

    <div class="card mt-8 ">
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
    </div>
@endsection
@push('scripts')
@endpush
