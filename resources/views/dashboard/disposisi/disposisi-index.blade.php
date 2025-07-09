    @extends('dashboard.layout')
    @section('content')
        <div class="card p-8">

            <div class="flex justify-between mb-4">
                <h4 class="h4">Penilaian Selesai</h4>



            </div>

            <hr class="my-4 border-t-2 border-gray-300">


            <table class="table-auto table-bordered w-full ">
                <thead>
                    <tr class="bg-blue-200 border-2">
                        <th class="px-4 py-2 text-left">Nama Formulir</th>
                        <th class="px-4 py-2 text-left">Yang melakukan</th>
                        <th class="px-4 py-2 text-left">Admin dituju</th>
                        <th class="px-4 py-2 text-left">Nama yang mengerjakan</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Completed</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($disposisis as $disposisi)
                        <tr class="border border-1">
                            <td class="px-4 py-2">{{ $disposisi->formulir->nama_formulir }}</td>
                            <td class="px-4 py-2">{{ $disposisi->fromProfile->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $disposisi->toProfile->name ?? '-'}}</td>
                            <td class="px-4 py-2">{{ $disposisi->assignedProfile->name ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if ($disposisi->status == 'proses')
                                    <button class="px-2 py-1 bg-yellow-600 text-white rounded">Proses</button>
                                @elseif ($disposisi->status == 'selesai')
                                    <button class="px-2 py-1 bg-green-500 text-white rounded">Selesai</button>
                                @else
                                    <button class="px-2 py-1 bg-red-600 text-white rounded">Batal</button>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ $disposisi->is_completed ? 'Ya' : 'Tidak' }}
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">

                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>


        </div>
    @endsection

    @push('scripts')
        <script>
            $('.deleteBtn').click(function(e) {

                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Anda tidak dapat mengembalikan user ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus user ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.preventDefault();
                        $('#form_delete').submit();

                    }
                })
            });
        </script>
    @endpush
