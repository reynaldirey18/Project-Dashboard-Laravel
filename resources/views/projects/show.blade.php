<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Detail Project
        </h2>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-2">{{ $project->nama_project }}</h3>
        <p><strong>Tanggal Mulai:</strong> {{ $project->tanggal_mulai->format('d-m-Y') }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $project->tanggal_selesai->format('d-m-Y') }}</p>
        <p><strong>Deskripsi:</strong> {{ $project->deskripsi ?? '-' }}</p>

        <a href="{{ route('projects.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Kembali ke Daftar</a>
    </div>
</x-app-layout>
