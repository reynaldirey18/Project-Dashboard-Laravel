<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Man Power
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-2">{{ $manpower->nama }}</h3>
        <p><strong>Lengkap:</strong> {{ $manpower->lengkap }}</p>
        <p><strong>Jabatan:</strong> {{ $manpower->jabatan }}</p>
        <p><strong>No Telepon:</strong> {{ $manpower->no_telepon }}</p>

        <a href="{{ route('manpowers.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Kembali ke Daftar</a>
    </div>
</x-app-layout>
