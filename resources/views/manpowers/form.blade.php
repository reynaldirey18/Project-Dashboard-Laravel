<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($manpower) ? 'Edit Man Power' : 'Tambah Man Power' }}
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

        <form action="{{ isset($manpower) ? route('manpowers.update', $manpower) : route('manpowers.store') }}" method="POST">
            @csrf
            @if(isset($manpower))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="nama" class="block font-semibold mb-1">Nama</label>
                <input type="text" id="nama" name="nama" class="w-full border rounded px-3 py-2"
                    value="{{ old('nama', $manpower->nama ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label for="lengkap" class="block font-semibold mb-1">Lengkap</label>
                <input type="text" id="lengkap" name="lengkap" class="w-full border rounded px-3 py-2"
                    value="{{ old('lengkap', $manpower->lengkap ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label for="jabatan" class="block font-semibold mb-1">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="w-full border rounded px-3 py-2"
                    value="{{ old('jabatan', $manpower->jabatan ?? '') }}" required>
            </div>

            <div class="mb-6">
                <label for="no_telepon" class="block font-semibold mb-1">No Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" class="w-full border rounded px-3 py-2"
                    value="{{ old('no_telepon', $manpower->no_telepon ?? '') }}" required>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('manpowers.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                    {{ isset($manpower) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
