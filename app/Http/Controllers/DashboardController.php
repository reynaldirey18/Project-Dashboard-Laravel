<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\ManPower;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalTasks = Task::count();
        $totalManPower = ManPower::count(); 

        $taskStatusCounts = Task::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('dashboard', compact('totalProjects', 'totalTasks', 'totalManPower', 'taskStatusCounts'));
    }
}
