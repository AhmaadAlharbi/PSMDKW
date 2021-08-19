<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TasksDetailsController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\PDFController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_admin');
Route::get('/sendtask', [TaskController::class, 'index'])->middleware('is_admin');
Route::get('/task_completed', [TaskController::class, 'task_completed'])->middleware('is_admin');
Route::get('/All_tasks', [TaskController::class, 'All_tasks'])->middleware('is_admin');
Route::get('/task_uncompleted', [TaskController::class, 'task_uncompleted'])->middleware('is_admin');
Route::get('/fill_task/{id}', [TasksDetailsController::class, 'fillTheTask'])->middleware('is_admin');
Route::get('/update_task/{id}', [TaskController::class, 'editTask'])->middleware('auth');
Route::post('/update_tasks/{id}', [TaskController::class, 'update'])->name('task.update');
Route::post('/TaskCompleted/{id}', [TasksDetailsController::class, 'TaskCompleted'])->name('TaskCompleted')->middleware('is_admin');
Route::post('/fill_pending_task/{id}', [TasksDetailsController::class, 'TaskPending'])->name('TaskPending')->middleware('is_admin');
Route::get('/taskDetails/{id}', [TasksDetailsController::class, 'showDetails'])->name('ShowTask')->middleware('is_admin');;
Route::get('/engineersArea/{id}/{shift_id}', [TaskController::class, 'getEngineersArea']);
Route::get('/engineersShift/{id}/{shiftID}', [TaskController::class, 'getEngineersShift']);
Route::get('/stationFullName/{id}', [TaskController::class, 'getStationFullName']);
// Route::get('/engineersEmail/{area_id}/{shift_id}/{engineer_id}',[TaskController::class,'getEngineersEmail']);
Route::get('/engineersEmail/{id}', [TaskController::class, 'getEngineersEmail']);
Route::get('/engineersEmail2/{id}', [TaskController::class, 'getEngineersEmail']);

Route::post('/sendtask', [TaskController::class, 'store'])->name('task.store')->middleware('is_admin');
Route::get('/Print_task/{id}', [TasksDetailsController::class, 'Print_task'])->middleware('is_admin');
Route::get('/Print_task/pdf/{id}', [TasksDetailsController::class, 'createPdf'])->middleware('is_admin');
Route::get('/add_your_report/{id}', [TasksDetailsController::class, 'addYourReport']);
Route::delete('/tasks.destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/stations-list', [StationsController::class, 'index'])->name('station.list');
Route::post('/add_station', [StationsController::class, 'store'])->name('station.add');
Route::get('/edit_station/{id}', [StationsController::class, 'edit'])->name('station.edit');
Route::post('/edit_station/{id}', [StationsController::class, 'update'])->name('station.update');
Route::post('/add_station', [StationsController::class, 'store'])->name('station.add');
Route::delete('/delete_station/{id}', [StationsController::class, 'destroy'])->name('station.destroy')->middleware('auth');
Route::get('/engineers-list', [EngineerController::class, 'index'])->name('engineer.list');
Route::post('/add_engineer', [EngineerController::class, 'store'])->name('engineer.add');
Route::get('/edit_engineer/{id}', [EngineerController::class, 'edit'])->name('engineer.edit');
Route::post('/edit_engineer/{id}', [EngineerController::class, 'update'])->name('engineer.update');
Route::delete('/delete_engineer/{id}', [EngineerController::class, 'destroy'])->name('engineer.destroy')->middleware('auth');
//attachments
Route::get('View_file/{refNum}/{file_name}',[TasksDetailsController::class,'open_file'])->name('view_file');
Route::get('download/{refNum}/{file_name}',[TasksDetailsController::class,'get_file']);
Route::post('delete_file',[TasksDetailsController::class,'destroy'])->name('delete_file');
//BLOGS
Route::get('/user/reports', [TasksDetailsController::class, 'blogs'])->name('blogs.blogs')->middleware('auth');
Route::get('/user/reports/{id}', [TasksDetailsController::class, 'blogDetails'])->name('blogs.details')->middleware('auth');
Route::get('/error', [TasksDetailsController::class, 'error'])->name('error');
Route::get('/user/reports/engineer/{id}', [TasksDetailsController::class, 'blogByEngineer'])->name('blogs.searchByEngineer')->middleware('auth');
Route::get('/user/reports/station/{id}', [TasksDetailsController::class, 'blogByStation'])->name('blogs.searchByStation')->middleware('auth');
//PDF
Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF']);

// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');




require __DIR__ . '/auth.php';