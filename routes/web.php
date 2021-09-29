<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TasksDetailsController;
use App\Http\Controllers\usersReportController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\EngineerController;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
Route::get('/task_to_be_assigned', [TaskController::class, 'toBeAssigned'])->middleware('is_admin');
Route::get('/task_completed', [TaskController::class, 'task_completed'])->middleware('is_admin');
Route::get('/All_tasks', [TaskController::class, 'All_tasks'])->middleware('auth');
Route::get('/archive', [TaskController::class, 'archive'])->middleware('auth')->name('archive');
Route::get('/archive/search_between_Dates', [TaskController::class, 'stationsByDates'])->name('staionsByDates');
Route::get('/task_uncompleted', [TaskController::class, 'task_uncompleted'])->middleware('is_admin');
Route::get('/fill_task/{id}', [TasksDetailsController::class, 'fillTheTask'])->middleware('is_admin');
Route::get('/update_task/{id}', [TaskController::class, 'editTask'])->name('editTask')->middleware('auth');
Route::get('/select-Engineer/{id}',[TaskController::class,'selectEngineer'])->name('selectEngineer');
Route::post('/update_tasks/{id}', [TaskController::class, 'update'])->name('task.update');
Route::post('/TaskCompleted/{id}', [TasksDetailsController::class, 'TaskCompleted'])->name('TaskCompleted');
Route::post('/fill_pending_task/{id}', [TasksDetailsController::class, 'TaskPending'])->name('TaskPending');
Route::get('/taskDetails/{id}', [TasksDetailsController::class, 'showDetails'])->name('ShowTask')->middleware('is_admin');;
Route::get('/engineersArea/{id}/{shift_id}', [TaskController::class, 'getEngineersArea']);
Route::get('/engineersShift/{id}/{shiftID}', [TaskController::class, 'getEngineersShift']);
Route::get('/stationFullName/{id}', [TaskController::class, 'getStationFullName']);
// Route::get('/engineersEmail/{area_id}/{shift_id}/{engineer_id}',[TaskController::class,'getEngineersEmail']);
Route::get('/engineersEmail/{id}', [TaskController::class, 'getEngineersEmail']);
Route::get('/engineersEmail2/{id}', [TaskController::class, 'getEngineersEmail']);
Route::get('/sendtask/night-shift',[TaskController::class,'nightShift'])->name('tasks.nightshift');
Route::post('/sendtask/night-shift',[TaskController::class,'storeNightShift'])->name('tasks.nightshiftCompleted');
Route::post('/sendtask', [TaskController::class, 'store'])->name('task.store')->middleware('is_admin');
Route::post('/task_to_be_assigned', [TaskController::class, 'storeWaitingToBeAssigned'])->name('task.waitingToBeAssigned')->middleware('is_admin');
Route::get('/reminder/{id}/{eng_email}/{ssname}', [TaskController::class, 'reminder'])->name('task.reminder')->middleware('is_admin');
Route::get('/Print_task/{id}', [TasksDetailsController::class, 'Print_task'])->name('print')->middleware('auth');
Route::get('/Print_task/pdf/{id}', [TasksDetailsController::class, 'createPdf'])->middleware('auth');
Route::get('/add_your_report/{id}', [TasksDetailsController::class, 'addYourReport'])->name('tasks.addYourReport');
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
Route::get('View_file/{refNum}/{file_name}', [TasksDetailsController::class, 'open_file'])->name('view_file');
Route::get('download/{refNum}/{file_name}', [TasksDetailsController::class, 'get_file']);
Route::post('delete_file', [TasksDetailsController::class, 'destroy'])->name('delete_file');
//BLOGS
Route::get('/user/reports', [TasksDetailsController::class, 'blogs'])->name('blogs.blogs')->middleware('auth');
Route::get('/user/reports/{id}', [TasksDetailsController::class, 'blogDetails'])->name('blogs.details')->middleware('auth');
Route::get('/error', [TasksDetailsController::class, 'error'])->name('error');
Route::get('/user/reports/engineer/{id}', [TasksDetailsController::class, 'blogByEngineer'])->name('blogs.searchByEngineer')->middleware('auth');
Route::get('/user/reports/station/{id}', [TasksDetailsController::class, 'blogByStation'])->name('blogs.searchByStation')->middleware('auth');
Route::get('users/All_tasks', [usersReportController::class, 'task_completed'])->name('user.allTasks')->middleware('auth');
Route::get('/user/All_tasks/{id}', [TasksDetailsController::class, 'userAll_tasks'])->name('blogs.mytasks')->middleware('auth');
Route::get('/user/uncompleted_tasks/{id}', [TasksDetailsController::class, 'userUncompleted_tasks'])->name('blogs.uncompletedTasks')->middleware('auth');
Route::get('/user/completed_tasks/{id}', [TasksDetailsController::class, 'usercompleted_tasks'])->name('blogs.completedTasks')->middleware('auth');
Route::get('user/taskDetails/{id}', [TasksDetailsController::class, 'usershowDetails'])->name('userShowTask')->middleware('auth');;
Route::get('user/Print_task/{id}', [TasksDetailsController::class, 'userPrint_task'])->name('user.print')->middleware('auth');
Route::get('/archive', [TaskController::class, 'archive'])->middleware('auth')->name('archive');
Route::get('/user/edit_report/{id}', [TasksDetailsController::class, 'userEditReport'])->name('userEditReport')->middleware('auth');
Route::get('user/reports/{id}',[TasksDetailsController::class,'update'])->name('blogs.userEditReport');
Route::post('user/reports/{id}',[TasksDetailsController::class,'update'])->name('blogs.userEditReport');
Route::get('user/archive', [TasksDetailsController::class, 'userArchive'])->middleware('auth')->name('user.archive');
Route::get('user/archive/search_between_Dates', [TasksDetailsController::class, 'userStationsByDates'])->name('user.staionsByDates');


//PDF
Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF']);
//Reset Passwords
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');




require __DIR__ . '/auth.php';