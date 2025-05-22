<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManPowerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('projects/data', [ProjectController::class, 'getData'])->name('projects.data');
    Route::resource('projects', ProjectController::class);

    Route::get('manpowers/data', [ManPowerController::class, 'getData'])->name('manpowers.data');
    Route::resource('manpowers', ManPowerController::class);


    Route::get('tasks/data', [TaskController::class, 'getData'])->name('tasks.data');
    Route::resource('tasks', TaskController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/report/export-excel', [ReportController::class, 'exportExcel'])->name('report.export.excel');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    
});

require __DIR__.'/auth.php';
