<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Man Power') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('manpowers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Man Power
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-4">
                <table id="manpower-table" class="w-full table-auto">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lengkap</th>
                            <th>Jabatan</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            $('#manpower-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('manpowers.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'lengkap', name: 'lengkap' },
                    { data: 'jabatan', name: 'jabatan' },
                    { data: 'no_telepon', name: 'no_telepon' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>
