<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Type;
use App\Traits\UploadTrait;
use App\Models\Admin\Status;
use Illuminate\Http\Request;
use App\Models\Admin\Activity;
use App\Exports\ActivityExport;
use Auth, Validator, Str, Excel;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use UploadTrait;

    public function __construct()
    {
        //$this->middleware('guest')->except(['logout','update']);
        $this->middleware('auth');
    }

    public function excel(Request $request)
    {
        $nameuser = $request->get('nameuser');
        
        return Excel::download(new ActivityExport($nameuser), 'busq-actividades.xlsx');
    }

    public function indexRole(Request $request)
    {
        if(Auth::user()->role==1):
            if($request->get('user')):
                $k = decrypt($request->get('user'));
                $activities = Activity::whereHas('user', function($query){
                                            $query->where('parent_id', Auth::user()->id);
                                        })->where('user_id', $k)->orderBy('created_at', 'Desc')->orderBy('name', 'Asc')->paginate();
            else:
                $activities = Activity::whereHas('user', function($query){
                                            $query->where('parent_id', Auth::user()->id);
                                        })->orderBy('created_at', 'Desc')->orderBy('name', 'Asc')->paginate();
            endif;
    
            $users = User::where('parent_id', Auth::user()->id)->orderBy('name', 'Asc')->get();
        else: //admin
            if($request->get('user')):
                $k = decrypt($request->get('user'));
                $activities = Activity::where('user_id', $k)->orderBy('created_at', 'Desc')->orderBy('name', 'Asc')->paginate();
            else:
                $activities = Activity::where('user_id','<>',Auth::user()->id)->orderBy('created_at', 'Desc')->orderBy('user_id', 'Desc')->paginate();
            endif;
    
            $users = User::where('id', '<>', Auth::user()->id)->orderBy('name', 'asc')->get();
        endif;

        return view('admin.activities.indexrole', compact('activities', 'users'));
    }

    public function editRole($id)
    {
        $id = decrypt($id);
        $activity = Activity::find($id);

        return view('admin.activities.editrole', compact('activity'));
    }

    public function updateRole(Request $request, $id)
    {
        $activity = Activity::find($id);
        $activity->fill($request->all())->save();
        return redirect()->route('activities.index.role')->with('message','Actualizado con éxito.')->with('typealert','success');
    }

    public function index(Request $request)
    {
        $complete = $request->get('complete');

        switch ($complete) {
            case '0':
                $activities = Activity::where('user_id', Auth::user()->id)->where('complete', 0)->orderBy('created_at', 'Desc')->paginate();
                break;
            case '1':
                $activities = Activity::where('user_id', Auth::user()->id)->where('complete', 1)->orderBy('created_at', 'Desc')->paginate();
                break;
            case '2':
                $activities = Activity::where('user_id', Auth::user()->id)->orderBy('created_at', 'Desc')->paginate();
                break;
            default:
                $activities = Activity::where('user_id', Auth::user()->id)->where('complete', 0)->orderBy('created_at', 'Desc')->paginate();
                break;
        }

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderBy('name', 'Asc')->get()->pluck('name','id')->prepend('Selecciona un tipo de archivo', NULL)->toArray();
        $status = Status::select(['id'])->where('order', '1')->first();

        return view('admin.activities.create' ,compact('types', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'status_id' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'task' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $messages=[
            'status_id.required'=> 'El status de la actividad no fue ingresado',
            'type_id.required'=> 'Seleccione el tipo de archivo a entregar',
            'name.required'=> 'Ingrese el nombre del proyecto',
            'task.required'=> 'Ingrese el nombre la tarea',
            'start_date.required'=> 'Ingrese la fecha de inicio',
            'end_date.required'=> 'Ingrese la fecha de fin',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $request->merge(['user_id' => Auth::user()->id]);
            $activity = Activity::create($request->all());
            if($request->has('file')):
                $file = $request->file('file');
                $folder = '/uploads/files/'.$activity->id;
                $name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = date('Y-m-d-h-i-s-').Str::slug($name);
                $filePath = $this->uploadOne($file, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
                //actualizamos el request enviado
                $activity->update(['file' => $filePath]);
            else:
                $activity->update(['file' => NULL]);
            endif;
            return redirect()->route('activities.index')->with('message','Creado con éxito.')->with('typealert','success');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        $types = Type::orderBy('name', 'Asc')->get()->pluck('name','id')->prepend('Selecciona un tipo de archivo', NULL)->toArray();
        //$status = Status::select(['id'])->where('order', '1')->first();

        return view('admin.activities.edit', compact('activity', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'type_id' => 'required',
            'name' => 'required',
            'task' => 'required',
            'end_date' => 'required',
        ];

        $messages=[
            'type_id.required'=> 'Seleccione el tipo de archivo a entregar',
            'name.required'=> 'Ingrese el nombre del proyecto',
            'task.required'=> 'Ingrese el nombre la tarea',
            'end_date.required'=> 'Ingrese la fecha de fin',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $activity = Activity::find($id);
            $activity->fill($request->all())->save();

            if($request->has('file')):
                $file = $request->file('file');
                $folder = '/uploads/files/'.$activity->id;
                $name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = date('Y-m-d-h-i-s-').Str::slug($name);
                $filePath = $this->uploadOne($file, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
                //actualizamos el request enviado
                $activity->update(['file' => $filePath]);
            endif;

            return redirect()->route('activities.index')->with('message','Actualizado con éxito.')->with('typealert','success');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id)->delete();

        return back()->with('message', 'Eliminado correctamente')->with('typealert','success');
    }
}