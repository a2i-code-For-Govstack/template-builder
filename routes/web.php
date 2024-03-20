<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Pdf\PDFController;
// use App\Http\Controllers\Form\FormOneController;
use App\Http\Controllers\Form\FormTwoController;
// use App\Http\Controllers\Form\FormController;
// use App\Http\Controllers\Category\CategoryController;
// use App\Http\Controllers\Home\HomeController;


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

Route::get('/', function () {
   return redirect()->route('home') ;
});

// Route::get('/test-pdf',function(){
//    $content="Test For New Romman";
//    return view('pdf-generator.loi-nov',compact(['content']));
// });

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group([
    'namespace' => 'App\Http\Controllers\Home',
    'prefix' => '/home',
    ], function () {
        Route::get('/', ['uses'=>'HomeController@index'])->name('home');
        Route::get('/usersrole', ['uses'=>'HomeController@usersrole'])->name('usersrole');
});

Route::middleware(['auth'])->group(function () {

    Route::group([
        'namespace' => 'App\Http\Controllers\User',
        ], function () {
            Route::resource('user', UserController::class);
            // Route::get('/assign-role', ['uses'=>'UserController@assignRole'])->name('assign-role');
            Route::get('/userdelete/{id}', ['uses'=>'UserController@deleteUser'])->name('delete-user');
    });

    Route::group([
        'namespace' => 'App\Http\Controllers\Role',
        ], function () {
            Route::resource('roles', RoleController::class);
            Route::post('/create-role', ['uses'=>'RoleController@createRole'])->name('create-role');
            Route::post('/create-permission', ['uses'=>'RoleController@createPermission'])->name('create-permission');
            Route::get('/role_permission', ['uses'=>'RoleController@role_permission'])->name('role_permission');
            Route::get('/role-delete/{id}', ['uses'=>'RoleController@role_delete'])->name('role-delete');
            Route::get('/permission-delete/{id}', ['uses'=>'RoleController@permission_delete'])->name('permission-delete');
            Route::get('/role-table', ['uses'=>'RoleController@roleTable'])->name('role-table');
            Route::get('/permission-table', ['uses'=>'RoleController@PermissionTable'])->name('permission-table');

            Route::get('/role-edit/{id}', ['uses'=>'RoleController@role_edit'])->name('role-edit');
            Route::get('/permission-edit/{id}', ['uses'=>'RoleController@permission_edit'])->name('permission-edit');

            Route::post('/role-update', ['uses'=>'RoleController@role_update'])->name('role-update');
            Route::post('/permission-update', ['uses'=>'RoleController@permission_update'])->name('permission-update');

    });



    Route::group([
        'namespace' => 'App\Http\Controllers\Pdf',
        'prefix' => '/pdf',
        ], function () {
            Route::get('/export-pdf', ['uses'=>'PDFController@exportPdf'])->name('export-pdf');
    });

    // Route::get('generate-pdf/{id}', [FormController::class, 'generatePDF']);

    Route::group([
            'namespace' => 'App\Http\Controllers\Category',
            'prefix' => '/category',
        ], function () {
            Route::get('/list',['uses'=>'CategoryController@index'])->name('category.list');
            Route::post('/create',['uses'=>'CategoryController@createCategory']);
            Route::post('/update',['uses'=>'CategoryController@updateCategory']);
            Route::get('/delete',['uses'=>'CategoryController@deleteCategory']);
            Route::get('/edit',['uses'=>'CategoryController@editCategory']);
    });

    Route::group([
            'namespace' => 'App\Http\Controllers\Form',
            'prefix' => '/form',
        ], function () {
            Route::get('/log/info', ['uses'=>'FormController@logIndex'])->name('log.info');
            Route::get('/log/show/{id}', ['uses'=>'FormController@logShow'])->name('log.show');
            Route::get('/log/edit/{id}', ['uses'=>'FormController@logEdit'])->name('log.edit');
            Route::put('/log/update/{id}', ['uses'=>'FormController@logUpdate'])->name('log.update');
            Route::get('form/{id}/delete',['uses'=>'FormController@deleteForm'])->name('form.delete');
            Route::resource('form', FormController::class);
            Route::get('/qrscan',['uses'=>'FormController@qrScan']);
            Route::get('table-parse',['uses'=>'FormController@tableParse']);
            Route::get('/form-one', ['uses'=>'FormOneController@index'])->name('form.one');
            Route::get('/form-two', ['uses'=>'FormTwoController@index'])->name('form.two');
            Route::get('/form-permission/info', ['uses'=>'FormPermissionController@index'])->name('form-permission.info');
            Route::get('/form/{id}/permission',['uses'=>'FormPermissionController@changePermission'])->name('form-permission.change');
            Route::post('/create-form-update-log', ['uses'=>'FormController@createFormUpdateLog'])->name('createFormUpdateLog');
            Route::get('/form-update-log-list/{id}', ['uses'=>'FormUpdateLogController@formUpdateLogList'])->name('formUpdateLogList');
            Route::get('/edit-form-update-log-list/{id}', ['uses'=>'FormUpdateLogController@editformUpdateLogList'])->name('editformUpdateLogList');
            Route::post('/update-form-update-log-list/{id}', ['uses'=>'FormUpdateLogController@updateformUpdateLogList'])->name('updateformUpdateLogList');
            Route::get('/form-update-log-set-live/{id}', ['uses'=>'FormUpdateLogController@formUpdateLogListSetlive'])->name('formUpdateLogListSetlive');
            Route::get('/pdf/show/{id}', ['uses'=>'FormController@FormPdfShow'])->name('pdf.show');
    });



});




