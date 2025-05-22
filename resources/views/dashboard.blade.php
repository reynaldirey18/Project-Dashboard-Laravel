<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-white text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Summary Boxes --}}
            <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold mb-2">Total Man Power</h3>
                    <p class="text-4xl font-bold">{{ $totalManPower }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold mb-2">Total Task (semua man power)</h3>
                    <p class="text-4xl font-bold">{{ $totalTasks }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-semibold mb-2">Task per Status</h3>
                    <p class="text-xl font-medium">
                        Pending: {{ $taskStatusCounts['Pending'] ?? 0 }}<br>
                        In Progress: {{ $taskStatusCounts['In Progress'] ?? 0 }}<br>
                        Done: {{ $taskStatusCounts['Done'] ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- Chart --}}
            <div class="bg-white p-6 rounded-lg shadow md:col-span-1">
                <h3 class="text-lg font-semibold mb-4 text-center">Distribusi Task per Status</h3>
                <canvas id="taskStatusChart" style="max-width: 100%; height: 320px;"></canvas>
            </div>

            {{-- Summary Table --}}
            <div class="bg-white p-6 rounded-lg shadow md:col-span-2 overflow-x-auto">
                <h3 class="text-lg font-semibold mb-4">Summary Table Task per Status</h3>
                <table id="summaryTable" class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Jumlah Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Pending</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $taskStatusCounts['Pending'] ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">In Progress</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $taskStatusCounts['In Progress'] ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Done</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $taskStatusCounts['Done'] ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        // Chart.js donut chart
        const ctx = document.getElementById('taskStatusChart').getContext('2d');
        const taskStatusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Progress', 'Done'],
                datasets: [{
                    label: 'Jumlah Task',
                    data: [
                        {{ $taskStatusCounts['Pending'] ?? 0 }},
                        {{ $taskStatusCounts['In Progress'] ?? 0 }},
                        {{ $taskStatusCounts['Done'] ?? 0 }},
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.8)',   
                        'rgba(54, 162, 235, 0.8)',   
                        'rgba(75, 192, 192, 0.8)'    
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 20, font: { size: 14 } }
                    }
                }
            }
        });

        $(document).ready(function() {
            $('#summaryTable').DataTable({
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                responsive: true,
            });
        });
    </script>
    @endpush
</x-app-layout>
