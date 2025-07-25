@extends('dashboard.layout')
@section('title', 'Tambah Pembinaan')
@section('content')
    <form action="{{ route('pembinaan.store') }}" method="POST" id="form_create">
        @csrf
        <div class="card px-8 py-4 pb-8 mb-8 border border-indigo-400">
            <div class="mb-4 px-0">
                <h4 class="h4 mb-2">Tambah Pembinaan</h4>
                <hr>
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Profile ID</label>
                    <select name="profile_id"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        required id="profile_select">
                        <option value="" disabled selected>Pilih Profile</option>
                        @foreach ($users as $profile)
                            <option value="{{ $profile->id }}" {{ old('profile_id') == $profile->id ? 'selected' : '' }}>
                                {{ $profile->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Judul Pembinaan</label>
                    <input type="text" placeholder="Judul pembinaan"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="judul_pembinaan" value="{{ old('judul_pembinaan') }}" required>
                </div>

                <div class="flex flex-col gap my-3">
                    <label class="font-semibold mb-2">Tanggal Pembinaan</label>
                    <input type="date" placeholder="Tanggal pembinaan"
                        class="p-2 rounded border border-gray-400 shadow focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 focus:bg-gray-200"
                        name="tanggal_pembinaan" value="{{ old('tanggal_pembinaan') }}" required>
                </div>




            </div>


        </div>


        <div class="card px-8 py-4 pb-8 mb-8 border border-indigo-400">
            <div class="mb-4 px-0">
                <h4 class="h4 mb-2">Tambahkan Peserta</h4>
                <hr>
            </div>

            <div class="flex justify-start">
                <button id="checkAll" type="button"
                    class="p-2 px-4 bg-green-500 text-white hover:bg-green-900 hover:text-white ease-in-out transition duration-100 border rounded-md w-40 flex items-center">
                    <i class="fad fa-check-double mr-2"></i> Check All</button>
                <button id="uncheckAll" type="button"
                    class="p-2 px-4 bg-red-500 text-white hover:bg-red-900 hover:text-white ease-in-out transition duration-100 border rounded-md ml-2 w-40 flex items-center">
                    <i class="fad fa-times-circle mr-2"></i> Uncheck All</button>
            </div>

            <table class="table-auto w-full mt-4">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 w-1/12"></th>
                        <th class="border px-4 py-2 text-left">Nama</th>
                        <th class="border px-4 py-2 text-left">NIM</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertas as $peserta_pembinaan)
                        <tr>
                            <td class="border px-4 py-2">
                                <input type="checkbox" name="peserta_pembinaan[]" value="{{ $peserta_pembinaan->id }}">
                            </td>
                            <td class="border px-4 py-2">{{ $peserta_pembinaan->name }}</td>
                            <td class="border px-4 py-2">
                                {{ $peserta_pembinaan->instansi->nama_instansi ?? 'Instansi Lorem Ipsum' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>






        </div>

        <button
            class="mt-5 p-2 px-8 bg-blue-500 text-white hover:bg-blue-900 hover:text-white ease-in-out transition duration-100 border rounded-md"
            type="submit">Tambahkan</button>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {


            $('#checkAll').click(function() {
                $('input[name="peserta_pembinaan[]"]').prop('checked', true).closest('tr').addClass(
                    'bg-green-200');
            });

            $('#uncheckAll').click(function() {
                $('input[name="peserta_pembinaan[]"]').prop('checked', false).closest('tr').removeClass(
                    'bg-green-200');
            });

            $('#profile_select').select2({
                dropdownCssClass: "tailwind-dropdown",
                selectionCssClass: "tailwind-selection"
            });


            $('input[name="peserta_pembinaan[]"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('tr').addClass('bg-green-200');
                } else {
                    $(this).closest('tr').removeClass('bg-green-200');
                }
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
