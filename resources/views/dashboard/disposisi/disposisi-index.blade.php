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
                    @foreach ($disposisis as $disposisi)
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
                                    {{-- <a href="{{ route('disposisi.edit', $disposisi->id) }}"
                                        class="text-green-600 hover:text-green-800 border rounded-md p-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('disposisi.destroy', $disposisi->id) }}" method="POST" id="form_delete"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="text-red-600 hover:text-red-800 border rounded-md p-2 deleteBtn"
                                            data-id="{{ $disposisi->id }}" data-nama="{{ $disposisi->formulir->nama_formulir }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('disposisi.show', $disposisi->id) }}"
                                        class="text-gray-800 hover:text-gray-600 border rounded-md px-2 py-1">
                                        <i class="fad fa-eye text-sm"></i>
                                    </a> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
