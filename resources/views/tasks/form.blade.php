<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ isset($task) ? 'Edit Task' : 'Tambah Task' }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <strong>Oops! Ada kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
            @csrf
            @if(isset($task))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="judul_task" class="block font-semibold mb-1">Judul Task</label>
                <input type="text" id="judul_task" name="judul_task"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('judul_task', $task->judul_task ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label for="project_id" class="block font-semibold mb-1">Project</label>
                <select id="project_id" name="project_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Project --</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ old('project_id', $task->project_id ?? '') == $project->id ? 'selected' : '' }}>
                            {{ $project->nama_project }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="man_powers" class="block font-semibold mb-1">Man Power</label>
                <select id="man_powers" name="man_powers[]" class="w-full border rounded px-3 py-2" multiple required>
                    @foreach($manpowers as $manpower)
                        <option value="{{ $manpower->id }}"
                            {{ (collect(old('man_powers', $selectedManpowers ?? []))->contains($manpower->id)) ? 'selected' : '' }}>
                            {{ $manpower->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('tasks.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                    {{ isset($task) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
