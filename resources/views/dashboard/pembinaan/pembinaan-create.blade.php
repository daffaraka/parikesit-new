@extends('dashboard.layout')
@section('content')
    <form action="{{ route('penjadwalan.store') }}" method="POST" id="form_create">
        @csrf
        <div class="card px-8 py-4 pb-8">
            <div class="mb-4 px-0">
                <h4 class="h4 mb-2">Tambah Penjadwalan</h4>
                <hr>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Profile ID</label>
                    <select name="profile_id"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        required id="profile_select">
                        <option value="" disabled selected>Pilih Profile</option>
                        @foreach ($users as $profile)
                            <option value="{{ $profile->id }}" {{ old('profile_id') == $profile->id ? 'selected' : '' }}>{{ $profile->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Judul Jadwal</label>
                    <input type="text" placeholder="Judul Jadwal"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="judul_jadwal" value="{{ old('judul_jadwal') }}" required>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Tanggal Jadwal</label>
                    <input type="date" placeholder="Tanggal Jadwal"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="tanggal_jadwal" value="{{ old('tanggal_jadwal') }}" required>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Waktu Mulai</label>
                    <input type="time" placeholder="Waktu Mulai"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="waktu_mulai" value="{{ old('waktu_mulai') }}" required>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Keterangan Jadwal</label>
                    <textarea placeholder="Keterangan Jadwal"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="keterangan_jadwal" required>{{ old('keterangan_jadwal') }}</textarea>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Pemateri Jadwal</label>
                    <input type="text" placeholder="Pemateri Jadwal"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="pemateri_jadwal" value="{{ old('pemateri_jadwal') }}" required>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Lokasi</label>
                    <textarea placeholder="Lokasi"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="lokasi" required>{{ old('lokasi') }}</textarea>
                </div>
            </div>
        </div>

        <button
            class="mt-5 p-2 px-8 bg-blue-500 text-white hover:bg-blue-900 hover:text-white ease-in-out transition duration-100 border rounded-md"
            type="submit">Tambahkan</button>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#profile_select').select2({
                dropdownCssClass: "tailwind-dropdown",
                selectionCssClass: "tailwind-selection"
            });

            // $('#form_create').submit(function(e) {
            //     e.preventDefault();

            //     $.ajax({
            //         url: $(this).attr('action'),
            //         method: $(this).attr('method'),
            //         data: new FormData(this),
            //         processData: false,
            //         dataType: 'json',
            //         contentType: false,
            //         success: function(response) {
            //             if (response.status) {
            //                 swal("Berhasil", response.message, "success");
            //                 window.location.href = "{{ route('formulir.index') }}";
            //             } else {
            //                 swal("Gagal", response.message, "error");
            //             }
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             swal("Gagal", xhr.responseText, "error");
            //         }
            //     });
            // });
        });
    </script>
@endpush

