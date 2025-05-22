<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Daftar Task
        </h2>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Task</a>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-4">
            <table id="task-table" class="w-full table-auto">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Task</th>
                        <th>Project</th>
                        <th>Man Power</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            $('#task-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tasks.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
                    { data: 'judul_task', name: 'judul_task' },
                    { data: 'project', name: 'project.nama_project' },
                    { data: 'manpowers', name: 'manpowers.nama' },
                    { data: 'aksi', name: 'aksi', orderable:false, searchable:false }
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>
