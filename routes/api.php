<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\FormController;
//use App\Http\Controllers\PdfController;

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Form\FormAnyController;
use App\Http\Controllers\Collection\CollectionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
        'namespace' => 'App\Http\Controllers\Auth',
    ], function () {
        Route::post('/login', ['uses'=>'LoginController@loginRequest']);
        Route::post('/register', ['uses'=>'RegisterController@registerRequest']);
    });


// Route::post('/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   $request->headers->set('Authorization', 'Bearer ' . $request->user()->api_token);
   return $request->user();
});
//Munir
//Route::post('log/update-api/', [FormController::class, 'logUpdateApis']);

//Route::post('/register', [RegisterController::class, 'register'])->middleware('guest','preventBackHistory');
Route::middleware('auth:sanctum')->group(function () {

    /*
        Route::get('/list', [FormController::class, 'getList'])->name('form.getList');
        Route::post('/content', [FormController::class, 'showContent'])->name('form.showContent');
        //Route::post('store/template/info', [FormController::class, 'storeInfo'])->name('form.storeInfo');
        //Route::post('download/pdf', [PdfController::class, 'downloadPdf'])->name('download-pdf');
        Route::post('/create/template', [FormController::class, 'createTemplate'])->name('form.createTemplate');
        // Route::post('log/update-api/', [FormController::class, 'logUpdateApi'])->name('log.update.api');
        Route::post('log/update-api/', [FormController::class, 'newlogUpdateApi'])->name('log.update.api');
        Route::post('log/get-last-update-data', [FormController::class, 'getLastUpdatedLog'])->name('log.get.data');
        Route::post('/get-letter-list', [FormController::class, 'getLetterList'])->name('form.getLetterList');
    */
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth','verified');
    Route::get('/form-any', [FormAnyController::class,'editor'])->name('form.editor')->middleware('auth','verified');
    Route::get('/form-any/{id}', [FormAnyController::class,'any'])->name('form.any')->middleware('auth','verified');
    Route::get('/form-any/background-only/{id}', [FormAnyController::class,'background'])->name('form.background-only')->middleware('auth','verified');
    Route::get('/collection', [CollectionController::class, 'index'])->name('collection')->middleware('auth', 'verified');
        
    Route::group([
        'namespace' => 'App\Http\Controllers\Api',
        'prefix' => '/form',
    ], function () {
        Route::get('/list', ['uses'=>'FormController@getList'])->name('form.getList');
        Route::post('/content', ['uses'=>'FormController@showContent'])->name('form.showContent');
        Route::post('/create/template', ['uses'=>'FormController@createTemplate'])->name('form.createTemplate');
        Route::post('/log/update-api/', ['uses'=>'FormController@newlogUpdateApi'])->name('log.update.api');
        Route::post('/log/get-last-update-data', ['uses'=>'FormController@getLastUpdatedLog'])->name('log.get.data');
        Route::post('/get-letter-list', ['uses'=>'FormController@getLetterList'])->name('form.getLetterList');
        //Route::post('login', [LoginController::class, 'login'])->middleware('guest','preventBackHistory');
    });

});




