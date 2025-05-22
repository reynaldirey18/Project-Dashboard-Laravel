<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\ManPower;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    public function getData(Request $request)
    {
        if (!$request->ajax()) abort(403);

        $data = Task::with('project', 'manpowers');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('project', fn($row) => $row->project->nama_project ?? '')
            ->addColumn('manpowers', fn($row) => $row->manpowers->pluck('nama')->join(', '))
            ->addColumn('aksi', function ($row) {
                $editUrl = route('tasks.edit', $row->id);
                $deleteForm = '<form action="'.route('tasks.destroy', $row->id).'" method="POST" onsubmit="return confirm(\'Yakin ingin menghapus?\')" style="display:inline">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="text-red-600 hover:underline">Hapus</button>'
                    . '</form>';
                return '<a href="'.$editUrl.'" class="text-blue-600 hover:underline mr-2">Edit</a>' . $deleteForm;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $projects = Project::all();
        $manpowers = ManPower::all();

        return view('tasks.form', compact('projects', 'manpowers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_task' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'man_powers' => ['required', 'array', 'min:1'],
            'man_powers.*' => ['required', 'distinct', 'exists:man_powers,id'],
        ], [
            'man_powers.required' => 'Minimal pilih 1 man power.',
            'man_powers.min' => 'Minimal pilih 1 man power.',
            'man_powers.*.distinct' => 'Man power tidak boleh dipilih lebih dari sekali.',
        ]);


        $task = Task::create([
            'judul_task' => $request->judul_task,
            'project_id' => $request->project_id,
        ]);

        $task->manpowers()->sync($request->man_powers);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dibuat.');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        $manpowers = ManPower::all();

        // Manpowers yang sudah terpilih
        $selectedManpowers = $task->manpowers->pluck('id')->toArray();

        return view('tasks.form', compact('task', 'projects', 'manpowers', 'selectedManpowers'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'judul_task' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'man_powers' => ['required', 'array', 'min:1'],
            'man_powers.*' => ['required', 'distinct', 'exists:man_powers,id'],
        ], [
            'man_powers.required' => 'Minimal pilih 1 man power.',
            'man_powers.min' => 'Minimal pilih 1 man power.',
            'man_powers.*.distinct' => 'Man power tidak boleh dipilih lebih dari sekali.',
        ]);

        $task->update([
            'judul_task' => $request->judul_task,
            'project_id' => $request->project_id,
        ]);

        $task->manpowers()->sync($request->man_powers);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }

    public function show(Task $task)
    {
        $task->load('project', 'manpowers');
        return view('tasks.show', compact('task'));
    }
}
