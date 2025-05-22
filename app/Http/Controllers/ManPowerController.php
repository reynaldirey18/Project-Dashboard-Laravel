<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManPowerRequest;
use App\Models\ManPower;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManPowerController extends Controller
{
    
    public function index()
    {
        return view('manpowers.index');
    }

    public function getData(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Access denied');
        }

        $data = ManPower::latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('manpowers.edit', $row->id);
                $deleteForm = '<form action="'.route('manpowers.destroy', $row->id).'" method="POST" class="inline-block" onsubmit="return confirm(\'Yakin ingin menghapus?\')">'
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
        return view('manpowers.form');  // kita buat form.blade.php yang dipakai create/edit
    }

    public function store(StoreManPowerRequest $request)
    {
        ManPower::create($request->validated());

        return redirect()->route('manpowers.index')->with('success', 'Man Power berhasil ditambahkan.');
    }

    public function edit(ManPower $manpower)
    {
        return view('manpowers.form', compact('manpower'));
    }

    public function update(StoreManPowerRequest $request, ManPower $manpower)
    {
        $manpower->update($request->validated());

        return redirect()->route('manpowers.index')->with('success', 'Man Power berhasil diperbarui.');
    }

    public function destroy(ManPower $manpower)
    {
        $manpower->delete();

        return redirect()->route('manpowers.index')->with('success', 'Man Power berhasil dihapus.');
    }

    public function show(ManPower $manpower)
    {
        return view('manpowers.show', compact('manpower'));
    }
}
