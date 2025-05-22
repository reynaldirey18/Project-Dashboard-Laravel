<x-app-layout>
    <x-slot name="header">
        <h2>Reporting Project</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 bg-white rounded shadow">

        <a href="{{ route('report.export.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
            Export to Excel
        </a>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-1">Nama Project</th>
                    <th class="border border-gray-300 px-3 py-1">Judul Task</th>
                    <th class="border border-gray-300 px-3 py-1">Status Task</th>
                    <th class="border border-gray-300 px-3 py-1">Man Powers</th>
                    <th class="border border-gray-300 px-3 py-1">Tanggal Mulai</th>
                    <th class="border border-gray-300 px-3 py-1">Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    @foreach ($project->tasks as $task)
                        <tr>
                            <td class="border border-gray-300 px-3 py-1">{{ $project->nama_project }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $task->judul_task }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $task->status }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $task->manpowers->pluck('nama')->join(', ') }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $project->tanggal_mulai->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 px-3 py-1">{{ $project->tanggal_selesai->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
