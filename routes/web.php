<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TesisController;
use Illuminate\Support\Facades\Auth;
use App\Models\Tesis;
use App\Models\User;

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

Route::resource('user', UserController::class);
//Route::resource('admin', App\Http\Controllers\AdminController::class);
//Route::resource('docente', App\Http\Controllers\DocenteController::class);
Route::resource('tesis', TesisController::class);


/*Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');*/


Route::get('/', function () {
    return redirect('home');
});


Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/home', [TesisController::class, 'indexHome'])->name('homeCa');
Route::post('/home/search', function () {
    $search_teses = Tesis::where('title', 'like', '%' . request()->searchN . '%')
                        //->orWhere('autor', 'like', '%' . request()->searchN . '%')
                        ->get();
    
    $users = User::where('role','=','Estudiante')
                ->get();

    return response()->json([
        'teses' => $search_teses,
        'autors' => $users
    ]);
});


Auth::routes(['verify' => true]);


Route::get('/perfil', function () {
    return view('profile');
})->middleware('verified')->name('profile');
Route::post('/perfil', [UserController::class, 'updatePassword'])->name('update-password');


Route::get('/usuarios', function () {
    return view('admin.usuarios');
});
Route::get('/usuarios', [UserController::class, 'index'])->middleware('verified')->name('usuarios');


Route::get('/registroTomo', function () {
    return view('alumno.tomo');
});
Route::get('/registroTomo', [App\Http\Controllers\TesisController::class, 'index'])->middleware('verified')->name('tomo');


Route::get('/revisionTutor', function () {
    return view('docente.tutor');
});
Route::get('/revisionTutor', [App\Http\Controllers\TesisController::class, 'indexTutor'])->middleware('verified')->name('tutor');


Route::get('/revisionJurado', function () {
    return view('docente.jurado');
});
Route::get('/revisionJurado', [App\Http\Controllers\TesisController::class, 'indexJurado'])->middleware('verified')->name('jury');


Route::get('/revisionDirector', function () {
    return view('director.director');
});
Route::get('/revisionDirector', [App\Http\Controllers\TesisController::class, 'indexDirector'])->middleware('verified')->name('director');


Route::get('/calendario', function () {
    return view('calendar');
})->middleware('verified');
Route::get('/calendario', [App\Http\Controllers\TesisController::class, 'indexCalendar'])->middleware('verified')->name('calendar');


//Route::resource('roles', RolesController::class);
//Route::resource('permissions', PermissionsController::class);
