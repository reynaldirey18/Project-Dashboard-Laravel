<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $projects = Project::with('tasks.manpowers')->get();

        $rows = collect();

        foreach ($projects as $project) {
            foreach ($project->tasks as $task) {
                $manpowers = $task->manpowers->pluck('nama')->join(', ');
                $rows->push([
                    'Nama Project' => $project->nama_project,
                    'Judul Task' => $task->judul_task,
                    'Status Task' => $task->status,
                    'Man Powers' => $manpowers,
                    'Tanggal Mulai' => $project->tanggal_mulai->format('d-m-Y'),
                    'Tanggal Selesai' => $project->tanggal_selesai->format('d-m-Y'),
                ]);
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Nama Project',
            'Judul Task',
            'Status Task',
            'Man Powers',
            'Tanggal Mulai',
            'Tanggal Selesai',
        ];
    }
}
