<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Validator, Auth, Hash, Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

class LoginController extends Controller
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
        $this->middleware('auth')->only(['indexall','create','edit','store','update','updateAdmin','destroy']);
    }

    public function index()
    {
        return view('admin.login.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPost(Request $request)
    {
        $rules=[
            'email'=>'required|email',
            'password'=>'required',
        ];

        $messages=[
            'email.required'=> 'Su email electrónico es requerido',
            'email.email'=> 'El formato de su correo electrónico es invalido',
            'password.required'=> 'Por favor escriba una contraseña',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)):
                return redirect()->route('admin');  
            else:
                return back()->with('message','Correo electrónico o contraseña erronea')->with('typealert','danger')->withInput();
            endif;
        endif;
    }

    public function indexall()
    {
        if(Auth::user()->role==0):
            $users = User::where('role','<>','0')->paginate();
        elseif(Auth::user()->role==1):
            $users = User::where('parent_id', Auth::user()->id)->paginate();
        endif;
        
        return view('admin.login.indexall', compact('users'));
    }
    
    public function create()
    {
        $supervisors = User::where('role','1')->get()->pluck('full_name','id')->prepend('Selecciona un supervisor', NULL)->toArray();
        return view('admin.login.create', compact('supervisors'));
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
            'name'=>'required|alpha_spaces',
            'lastname'=>'required|alpha_spaces',
            'email' => 'required|email_final|unique:App\Models\User,email',
            'role' => 'required',
            'password'=>'required|min:8',
            'repassword'=>'required|min:8|same:password',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages=[
            'name.required'=> 'Ingrese su nombre',
            'lastname.required'=>'Ingrese su apellido',
            'name.alpha_spaces'=>'Ingrese un nombre válido',
            'lastname.alpha_spaces'=>'Ingrese un apellido válido',
            'email.unique'=>'El email ingresado ya se encuentra registrado',
            'email.required'=>'Ingrese su email',
            'email.email_final'=>'Ingrese un email válido',
            'role.required'=>'Seleccione el perfil del usuario',
            'password.required'=> 'Por favor escriba su contraseña',
            'repassword.required'=> 'Por favor escriba nuevamente la contraseña',
            'password.min'=> 'La contraseña debe tener al menos 8 caracteres',
            'repassword.min'=> 'La contraseña debe tener al menos 8 caracteres',
            'repassword.same'=> 'Las contraseñas no coinciden',
            'avatar.image'=> 'El archivo subido para la imagen de perfil es inválida',
            'avatar.mimes'=> 'Solo se aceptan imágenes(jpeg, jpg, png, gif) para la foto de perfil',
            'avatar.max'=> 'El peso máximo permitido para la foto de perfil es de 2MB',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            if($request->password==$request->repassword):
                $request->merge(['password' => Hash::make($request->password)]);
                $user = User::create($request->all());
                //imagen
                if($request->has('avatar')):
                    $image = $request->file('avatar');
                    $folder = '/uploads/users';
                    $name = pathinfo($request->avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $name = date('Y-m-d-h-i-s-').Str::slug($name);
                    $filePath = $this->uploadOne($image, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
                    //actualizamos el request enviado
                    $user->update(['avatar' => $filePath]);
                else:
                    $user->update(['avatar' => 'static/admin/images/avatar.jpg']);
                endif;
                return redirect()->route('login.all')->with('message','Usuario creado con éxito.')->with('typealert','success');
            else:
                return back()->withErrors($validator)->with('Las contraseñas no coinciden')->with('typealert','danger')->withInput();
            endif;
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
        $user = User::find($id);
        $supervisors = User::where('role','1')->get()->pluck('full_name','id')->prepend('Selecciona un supervisor', NULL)->toArray();

        return view('admin.login.edit', compact('user', 'supervisors'));
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
            'password'=>'required',
            'newpassword'=>'required|min:8',
            'renewpassword'=>'required|min:8|same:newpassword',
        ];

        $messages=[
            'password.required'=> 'Por favor escriba su contraseña',
            'newpassword.required'=> 'Por favor escriba su nueva contraseña',
            'renewpassword.required'=> 'Por favor escriba nuevamente su nueva contraseña',
            'newpassword.min'=> 'La nueva contraseña debe tener al menos 8 caracteres',
            'renewpassword.min'=> 'La nueva contraseña debe tener al menos 8 caracteres',
            'renewpassword.same'=> 'Las contraseñas no coinciden',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $user=User::find(Auth::user()->id);
            if(Hash::check($request->password, Auth::user()->password)):
                $user->password=Hash::make($request->newpassword);
                $user->save();
                return back()->with('message','Contraseña actualizada con éxito')->with('typealert','success');
            else:
                return back()->withErrors($validator)->with('message','La contraseña ingresada no coincide')->with('typealert','danger')->withInput();
            endif;
        endif;
    }

    public function updateAdmin(Request $request, $id)
    {

        $rules=[
            'name' => 'required|alpha_spaces',
            'lastname' => 'required|alpha_spaces',
            'email' => 'email_final|unique:App\Models\User,email,'.$id,
            'role' => 'required',
            'repassword' => 'same:password',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages=[
            'name.required'=> 'Ingrese su nombre',
            'lastname.required'=>'Ingrese su apellido',
            'name.alpha_spaces'=>'Ingrese un nombre válido',
            'lastname.alpha_spaces'=>'Ingrese un apellido válido',
            'email.unique'=>'El email ingresado ya se encuentra registrado',
            'email.email_final'=>'Ingrese un email válido',
            'role.required'=>'Seleccione el perfil del usuario',
            'repassword.same'=> 'Las contraseñas no coinciden',
            'avatar.image'=> 'El archivo subido para la imagen de perfil es inválida',
            'avatar.mimes'=> 'Solo se aceptan imágenes(jpeg, jpg, png, gif) para la foto de perfil',
            'avatar.max'=> 'El peso máximo permitido para la foto de perfil es de 2MB',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $user=User::find($id);
            //Actualizo contraseña
            if($request->password):
                $request->merge(['password' => Hash::make($request->password)]);
            else:
                $request->merge(['password' => $user->password]);
            endif;
            //Si cambiamos de supervisor a usuario normal, se actualiza se actualiza el campo parent a sus usuarios asignados
            if($user->role==1 && $request->role==2):
                $user_act = User::where('parent_id', $user->id)->update(['parent_id' => NULL]);
            endif;
            $user->fill($request->all())->save();
            //Subimos la imagen después de la validación
            if($request->has('avatar')):
                $image = $request->file('avatar');
                $folder = '/uploads/users';
                $name = pathinfo($request->avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $name = date('Y-m-d-h-i-s-').Str::slug($name);
                $filePath = $this->uploadOne($image, $folder, 'uploads', $name); //se guarda en disco y retorna el path del archivo
                //actualizamos la url en la bd
                $user->update(['avatar' => $filePath]);
            endif;
            return redirect()->route('login.all')->with('message','Usuario actualizado correctamente')->with('typealert','success');
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
        $user = User::find($id);
        $user_act = User::where('parent_id', $user->id)->update(['parent_id' => NULL]);
        //dd($user_act);
        $user->delete();

        return back()->with('message', 'Eliminado correctamente')->with('typealert','success');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
