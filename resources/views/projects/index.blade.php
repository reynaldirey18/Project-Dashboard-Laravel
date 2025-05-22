<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-white font-semibold leading-tight text-gray-800">
            {{ __('Daftar Project') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Tambah Project
                </a>
            </div>

            <div class="bg-white p-4 shadow-sm rounded-lg">
                <table id="project-table" class="w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Project</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#project-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('projects.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_project', name: 'nama_project' },
                    { data: 'tanggal_mulai', name: 'tanggal_mulai' },
                    { data: 'tanggal_selesai', name: 'tanggal_selesai' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>
