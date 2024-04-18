<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficialController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/login', function(){

    if (auth()->check()){
        switch (auth()->user()->role){
            case 'student':
                return redirect('/');
                break;
            case 'official':
                return redirect('/official');
                break;
            case 'admin':
                return redirect('/admin');
                break;
        }
    }else{
        return view('auth.login');
    }
})->name('login');

Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::middleware(['auth', 'user-role:student'])->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', 'StudentHome')->name('StudentHome');
        Route::get('/student-profile', 'StudentProfile')->name('StudentProfile');
        Route::get('/student-application', 'StudentApplication')->name('StudentApplication');
    });
});

Route::middleware(['auth', 'user-role:official'])->group(function(){
    Route::controller(OfficialController::class)->group(function(){
        Route::get('/official', 'OfficialHome')->name('OfficialHome');
        Route::get('/official-profile', 'OfficialProfile')->name('OfficialProfile');
        Route::get('/official-application', 'OfficialApplication')->name('OfficialApplication');
        Route::get('/official-application-info/{sem}/{sy}', 'OfficialApplicationInfo')->name('OfficialApplicationInfo');
        Route::get('/official-records', 'RecordSection')->name('RecordSection');
        Route::get('/download-file/{file}', 'downloadGrade')->name('downloadGrade');
        Route::get('/download-deanslist/{semester_id}/{office?}/{program?}/', 'DownloadDeansList')->name('DownloadDeansList');
    });
});

Route::middleware(['auth', 'user-role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin', 'AdminHome')->name('AdminHome');
        Route::get('/admin-accounts', 'AdminAccount')->name('AdminAccount');
        Route::get('/admin-programs', 'AdminPrograms')->name('AdminPrograms');
    });
});
