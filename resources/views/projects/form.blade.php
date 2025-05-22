<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ isset($project) ? 'Edit Project' : 'Tambah Project' }}
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

        <form action="{{ isset($project) ? route('projects.update', $project) : route('projects.store') }}" method="POST">
            @csrf
            @if(isset($project))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="nama_project" class="block font-semibold mb-1">Nama Project</label>
                <input type="text" id="nama_project" name="nama_project"
                       class="w-full border rounded px-3 py-2"
                       value="{{ old('nama_project', $project->nama_project ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi"
                          class="w-full border rounded px-3 py-2"
                          rows="3">{{ old('deskripsi', $project->deskripsi ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="tanggal_mulai" class="block font-semibold mb-1">Tanggal Mulai</label>
                <input type="text" id="tanggal_mulai" name="tanggal_mulai"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('tanggal_mulai', isset($project) ? $project->tanggal_mulai->format('d-m-Y') : '') }}" required>
            </div>

            <div class="mb-6">
                <label for="tanggal_selesai" class="block font-semibold mb-1">Tanggal Selesai</label>
                <input type="text" id="tanggal_selesai" name="tanggal_selesai"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('tanggal_selesai', isset($project) ? $project->tanggal_selesai->format('d-m-Y') : '') }}" required>

            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('projects.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Batal
                </a>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                    {{ isset($project) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
    <script>
        const tanggalMulai = flatpickr("#tanggal_mulai", {
        dateFormat: "d-m-Y",
        allowInput: true,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    tanggalSelesai.set('minDate', selectedDates[0]);
                    // Kalau tanggal selesai sebelumnya lebih kecil, reset supaya valid
                    if (tanggalSelesai.selectedDates.length > 0 && tanggalSelesai.selectedDates[0] < selectedDates[0]) {
                        tanggalSelesai.clear();
                    }
                }
            }
        });

        const tanggalSelesai = flatpickr("#tanggal_selesai", {
            dateFormat: "d-m-Y",
            allowInput: true,
            minDate: null,
        });
    </script>
</x-app-layout>
