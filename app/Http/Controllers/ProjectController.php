<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
      public function show($id)
      {
          $project = Project::findOrFail($id);
          return view('projects.show', compact('project'));
      }
    /**
     * Tampilkan halaman index project.
     */
    public function index()
    {
        return view('projects.index'); // AJAX akan isi tabel
    }

    /**
     * Tampilkan form tambah project.
     */
    public function create()
    {
        return view('projects.form');
    }

    /**
     * Simpan data project baru.
     */
    public function store(Request $request)
    {
        $this->validateProject($request);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit project.
     */
    public function edit(Project $project)
    {
        return view('projects.form', compact('project'));
    }

    /**
     * Simpan perubahan project.
     */
    public function update(Request $request, Project $project)
    {
        $this->validateProject($request);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project berhasil diupdate.');
    }

    /**
     * Hapus project.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }

    /**
     * Validasi reusable untuk store dan update.
     */
    protected function validateProject(Request $request)
    {
        $request->validate([
            'nama_project' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'nullable|string',
        ]);
    }

    /**
     * Ambil data project untuk DataTables AJAX.
     */
    public function getData(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Access denied');
        }
    
        $data = Project::latest();
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal_mulai', fn($row) => optional($row->tanggal_mulai)->format('d-m-Y'))
            ->editColumn('tanggal_selesai', fn($row) => optional($row->tanggal_selesai)->format('d-m-Y'))
            ->addColumn('aksi', function ($row) {
                $editUrl = route('projects.edit', $row->id);
                $deleteForm = '<form action="'.route('projects.destroy', $row->id).'" method="POST" class="inline-block" onsubmit="return confirm(\'Yakin ingin menghapus?\')">'
                            . csrf_field()
                            . method_field('DELETE')
                            . '<button type="submit" class="text-red-600 hover:underline">Hapus</button>'
                            . '</form>';
                return '<a href="'.$editUrl.'" class="text-blue-600 hover:underline mr-2">Edit</a>' . $deleteForm;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
