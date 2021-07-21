<?php

namespace App\Http\Controllers\Admin;

use Validator, Auth, Hash, Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

class ProfileController extends Controller
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

    public function index()
    {
        $profile = User::find(Auth::user()->id);
        return view('admin.profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
            'name' => 'required|alpha_spaces',
            'lastname' => 'required|alpha_spaces',
            'repassword'=>'same:password',
        ];

        $messages=[
            'name.required'=> 'Ingrese su nombre',
            'lastname.required'=>'Ingrese su apellido',
            'name.alpha_spaces'=>'Ingrese un nombre válido',
            'lastname.alpha_spaces'=>'Ingrese un apellido válido',
            'repassword.same'=> 'Las contraseñas no coinciden',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $user = User::find($id);
            //Actualizo contraseña
            if($request->password):
                $request->merge(['password' => Hash::make($request->password)]);
            else:
                $request->merge(['password' => $user->password]);
            endif;
            $user->fill($request->all())->save();

            return redirect()->route('profile.index')->with('message','Actualizado correctamente')->with('typealert','success');
        endif;
    }

    public function updateImage(Request $request)
    {
        if($request->has('avatar')):
            $user = User::find(Auth::user()->id);
            $image = $request->file('avatar');
            $folder = '/uploads/users';
            $name = pathinfo($request->avatar->getClientOriginalName(), PATHINFO_FILENAME);
            $name = date('Y-m-d-h-i-s-').Str::slug($name);
            $filePath = $this->uploadOne($image, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
            //actualizamos la url en la bd
            $user->update(['avatar' => $filePath]);
            return $filePath;
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
        //
    }
}
