<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Activity;
use App\Models\Admin\Progress;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('isadmin');
    }

    public function proyectosindex()
    {
        return view('admin.test.indexproyectos');
    }

    public function proyectosshow()
    {
        return view('admin.test.showproyectos');
    }

    public function proyectos()
    {
        return view('admin.test.proyectos');
    }

    public function componentes()
    {
        return view('admin.test.componentes');
    }

    public function funcionalidades()
    {
        return view('admin.test.funcionalidades');
    }

    public function dashboard()
    {
        $usuarios = User::where('role', '<>', '0')->count();
        $usuarios_supervisores = User::where('role', '2')->count();
        $usuarios_normales = User::where('role', '1')->count();
        $usuarios_asignados = User::where('parent_id', Auth::user()->id)->count();
        $actividades = Activity::where('user_id', Auth::user()->id)->count();
        $actividades_pendientes = Activity::where('complete', 0)->where('user_id', Auth::user()->id)->count();
        $actividades_finalizadas = Activity::where('complete', 1)->where('user_id', Auth::user()->id)->count();
        $feedback_pendientes_actividades = Activity::whereHas('user', function($q){
                                                        $q->where('parent_id', Auth::user()->id);
                                                    })->whereNull('feedback')->count();
        $feedback_pendientes_avances = Progress::whereHas('activity', function($q){
                                                        $q->whereHas('user', function($query){
                                                            $query->where('parent_id', Auth::user()->id);
                                                        });
                                                    })->whereNull('feedback')->count();

        return view('admin.dashboard.index', compact(
                                                    ['usuarios', 
                                                    'usuarios_supervisores',
                                                    'usuarios_normales',
                                                    'usuarios_asignados',
                                                    'actividades', 
                                                    'actividades_pendientes', 
                                                    'actividades_finalizadas',
                                                    'feedback_pendientes_actividades',
                                                    'feedback_pendientes_avances']
                                                ));
    }
}
