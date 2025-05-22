<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Detail Task
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">{{ $task->judul_task }}</h3>

        <p><strong>Project:</strong> {{ $task->project->nama_project ?? '-' }}</p>

        <p><strong>Man Power:</strong></p>
        @if($task->manpowers->count() > 0)
            <ul class="list-disc list-inside mb-4">
                @foreach($task->manpowers as $manpower)
                    <li>{{ $manpower->nama }}</li>
                @endforeach
            </ul>
        @else
            <p>-</p>
        @endif

        <a href="{{ route('tasks.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Kembali ke Daftar Task</a>
    </div>
</x-app-layout>
