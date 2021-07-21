<?php

use Illuminate\Support\Facades\Route;

Route::post('loginpost', [App\Http\Controllers\Admin\LoginController::class,'indexPost'])->name('login.post');
Route::get('logout', [App\Http\Controllers\Admin\LoginController::class,'logout'])->name('login.logout');
Route::get('loginall', [App\Http\Controllers\Admin\LoginController::class,'indexall'])->name('login.all');
Route::resource('login', App\Http\Controllers\Admin\LoginController::class)->only(['index'])->middleware(['guest']);
Route::resource('login', App\Http\Controllers\Admin\LoginController::class)->only(['create','store','edit', 'update', 'destroy']);
Route::put('updateAdmin/{id}', [App\Http\Controllers\Admin\LoginController::class,'updateAdmin'])->name('login.updateadmin');
Route::prefix('/admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin');
    Route::resource('profile', App\Http\Controllers\Admin\ProfileController::class);
    Route::post('profileimage', [App\Http\Controllers\Admin\ProfileController::class,'updateImage'])->name('profile.update.image');
    Route::resource('types', App\Http\Controllers\Admin\TypeController::class);
    Route::resource('status', App\Http\Controllers\Admin\StatusController::class);
    Route::resource('activities', App\Http\Controllers\Admin\ActivityController::class);
    Route::get('activitiesrole', [App\Http\Controllers\Admin\ActivityController::class,'indexRole'])->name('activities.index.role');
    Route::get('activitieseditrole/{id}', [App\Http\Controllers\Admin\ActivityController::class,'editRole'])->name('activities.edit.role');
    Route::put('activitiesupdaterole/{id}', [App\Http\Controllers\Admin\ActivityController::class,'updateRole'])->name('activities.update.role');
    Route::resource('progress', App\Http\Controllers\Admin\ProgressController::class);
    Route::get('progressrole', [App\Http\Controllers\Admin\ProgressController::class,'indexRole'])->name('progress.index.role');
    Route::get('progresseditrole/{id}', [App\Http\Controllers\Admin\ProgressController::class,'editRole'])->name('progress.edit.role');
    Route::put('progressupdaterole/{id}', [App\Http\Controllers\Admin\ProgressController::class,'updateRole'])->name('progress.update.role');
    Route::post('maxpercentage', [App\Http\Controllers\Admin\ProgressController::class,'getMaxPercentage'])->name('progress.maxpercentage');

    Route::get('excelactivity',[App\Http\Controllers\Admin\ActivityController::class,'excel'])->name('activities.excel');
    Route::get('excelprogress',[App\Http\Controllers\Admin\ProgressController::class,'excel'])->name('progress.excel');
});
