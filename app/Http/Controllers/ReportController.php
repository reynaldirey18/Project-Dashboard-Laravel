<?php
namespace App\Http\Controllers;

use App\Exports\ProjectReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $projects = \App\Models\Project::with('tasks.manpowers')->get();

        return view('report', compact('projects'));
    }

    public function exportExcel()
    {
        $fileName = 'project_report_'.date('Ymd_His').'.xlsx';
        return Excel::download(new ProjectReportExport, $fileName);
    }
}
