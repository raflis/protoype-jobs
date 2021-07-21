<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Auth, Validator, Str, Excel;
use App\Traits\UploadTrait;
use App\Models\Admin\Status;
use Illuminate\Http\Request;
use App\Models\Admin\Activity;
use App\Models\Admin\Progress;
use App\Exports\ProgressExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class ProgressController extends Controller
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
        
        return Excel::download(new ProgressExport($nameuser), 'busq-avances.xlsx');
    }

    public function getMaxPercentage(Request $request)
    {
        $percentage = Progress::select('percentage')->where('activity_id', $request->activity_id)->orderBy('id', 'Desc')->first();
        if($percentage):
            return $percentage->percentage;
        else:
            return 0;
        endif;
    }

    public function indexRole(Request $request)
    {
        if(Auth::user()->role==1):
            if($request->get('user')):
                $k = decrypt($request->get('user'));
                $progress = Progress::whereHas('activity', function($query) use($k){
                                        $query->where('user_id', $k);
                                        })->orderBy('created_at', 'Desc')->orderBy('activity_id', 'Asc')->paginate();
            else:
                $progress = Progress::whereHas('activity', function($query){
                                        $query->whereHas('user', function($q){
                                            $q->where('parent_id', Auth::user()->id);
                                            });
                                        })->orderBy('created_at', 'Desc')->orderBy('activity_id', 'Asc')->paginate();
            endif;
    
            $users = User::where('parent_id', Auth::user()->id)->orderBy('name', 'asc')->get();
        else: //admin
            if($request->get('user')):
                $k = decrypt($request->get('user'));
                $progress = Progress::whereHas('activity', function($query) use($k){
                                        $query->where('user_id', $k);
                                        })->orderBy('created_at', 'Desc')->orderBy('id', 'desc')->paginate();
            else:
                $progress = Progress::whereHas('activity', function($query){
                                            $query->where('user_id', '<>', Auth::user()->id);
                                        })->orderBy('created_at', 'Desc')->orderBy('activity_id', 'Desc')->orderBy('id', 'desc')->paginate();
            endif;
    
            $users = User::where('id', '<>', Auth::user()->id)->orderBy('name', 'asc')->get();
        endif;

        return view('admin.progress.indexrole', compact('progress', 'users'));
    }

    public function editRole($id)
    {
        $id = decrypt($id);
        $progress = Progress::find($id);

        return view('admin.progress.editrole', compact('progress'));
    }

    public function updateRole(Request $request, $id)
    {
        $progress = Progress::find($id);
        $progress->fill($request->all())->save();
        return redirect()->route('progress.index.role')->with('message','Actualizado con éxito.')->with('typealert','success');
    }

    public function index(Request $request)
    {
        if($request->get('k')):
            $k = decrypt($request->get('k'));
            $progress = Progress::whereHas('activity', function($query){
                                    $query->where('user_id', Auth::user()->id);
                                    })->where('activity_id', $k)->orderBy('activity_id', 'Asc')->paginate();
        else:
            $progress = Progress::whereHas('activity', function($query){
                                    $query->where('user_id', Auth::user()->id);
                                    })->orderBy('created_at', 'Desc')->orderBy('activity_id', 'Asc')->paginate();
        endif;

        $activities = Activity::where('user_id', Auth::user()->id)->select('name', 'id')->orderBy('name', 'Asc')->get();

        return view('admin.progress.index', compact('progress', 'activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->get('k')):
            $k = decrypt($request->get('k'));
            $activities = Activity::where('id', $k)->pluck('name','id');
            $percentageMax = Progress::select('percentage')->where('activity_id', $k)->orderBy('id', 'Desc')->first();
            if($percentageMax):
                $percentage = $percentageMax->percentage + 1;
            else:
                $percentage = 1;
            endif;
        else:
            $activities = Activity::where('complete', '<>', 1)->where('user_id', Auth::user()->id)->orderBy('name', 'Asc')->get()->pluck('name','id')->prepend('Selecciona un proyecto', NULL)->toArray();
            $percentage = 1;
        endif;

        return view('admin.progress.create', compact('activities', 'percentage'));
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
            'activity_id' => 'required',
            'percentage' => 'required'
        ];

        $messages=[
            'activity_id.required'=> 'Selecciona un proyecto',
            'percentage.required'=> 'Ingresa el % porcentaje avanzado',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            if($request->percentage == 100):
                $status_id = Status::select(['id'])->orderBy('order', 'Desc')->first();
                $activity = Activity::find($request->activity_id)->update(['status_id' => $status_id->id, 'complete' => 1]);
            endif;
            $progress = Progress::create($request->all());
            if($request->has('file')):
                $file = $request->file('file');
                $folder = '/uploads/files/'.$request->activity_id;
                $name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = date('Y-m-d-h-i-s-').Str::slug($name);
                $filePath = $this->uploadOne($file, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
                //actualizamos el request enviado
                $progress->update(['file' => $filePath]);
            else:
                $progress->update(['file' => NULL]);
            endif;
            return redirect()->route('progress.index')->with('message','Creado con éxito.')->with('typealert','success');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $progress = Progress::find($id);
        $activities = Activity::where('id', $progress->activity_id)->pluck('name','id');

        return view('admin.progress.edit', compact('progress', 'activities'));
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
            'activity_id' => 'required',
        ];

        $messages=[
            'activity_id.required'=> 'Selecciona un proyecto',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $progress = Progress::find($id);
            $progress->fill($request->all())->save();

            if($request->has('file')):
                $file = $request->file('file');
                $folder = '/uploads/files/'.$request->activity_id;
                $name = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = date('Y-m-d-h-i-s-').Str::slug($name);
                $filePath = $this->uploadOne($file, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
                //actualizamos el request enviado
                $progress->update(['file' => $filePath]);
            endif;
            return redirect()->route('progress.index')->with('message','Actualizado con éxito.')->with('typealert','success');
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
        $progress = Progress::find($id)->delete();

        return back()->with('message', 'Eliminado correctamente')->with('typealert','success');
    }
}
