<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/template', function () {
    return view('welcome');
})->name('template');

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::post('/punch', 'HomeController@punch')->name('punch');

//AJAX
Route::post('/setNewCarData', 'Admin\Menu\CarDataController@setNewCarData')->name('setNewCarData');

/**
 * 後台 Route
 */
Route::get('admin-login','Admin\AdminController@loginPage')->name('admin-login');//後台登入頁

Route::group(['prefix'=>'admin', 'middleware' => ['web', 'admin.area'],'as'=>'admin.'],function (){
    /** 首頁*/
    Route::get('/','Admin\AdminController@index')->name('index');
    /**
     * 快取清除
     */
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return redirect()->back()->with('message', '快取已清除!');
    })->name('clear-cache');

    Route::group(['prefix' => 'import-export', 'as' => 'import-export.'], function(){
        Route::post('/import', 'Admin\Menu\ImportExportController@import')
            ->name('import');
        Route::post('/export', 'Admin\Menu\ImportExportController@export')
            ->name('export');
        Route::post('/sendmail', 'Admin\Menu\ImportExportController@sendmail')
            ->name('sendmail');
    });
    Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function(){
        Route::post('/changeEventDate', 'Admin\Menu\CalendarController@changeEventDate')
            ->name('changeEventDate');
        Route::post('/EventDelete', 'Admin\Menu\CalendarController@EventDelete')
            ->name('EventDelete');
    });
    Route::resource('carData', 'Admin\Menu\CarDataController', ['except' => [
        'show'
    ]]);

    Route::resource('comment', 'Admin\Menu\CommentLogController', ['except' => [
        'show'
    ]]);
});



