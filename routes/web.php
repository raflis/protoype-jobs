<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard']);
Route::get('proyectosindex', [App\Http\Controllers\Admin\DashboardController::class, 'proyectosindex'])->name('proyectos.index');
Route::get('proyectosshow', [App\Http\Controllers\Admin\DashboardController::class, 'proyectosshow'])->name('proyectos.show');
Route::get('proyectos', [App\Http\Controllers\Admin\DashboardController::class, 'proyectos'])->name('proyectos');
Route::get('componentes', [App\Http\Controllers\Admin\DashboardController::class, 'componentes'])->name('componentes');
Route::get('funcionalidades', [App\Http\Controllers\Admin\DashboardController::class, 'funcionalidades'])->name('funcionalidades');
