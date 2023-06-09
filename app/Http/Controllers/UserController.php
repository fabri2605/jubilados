<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Oficina;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Rules\UserPassword;
use App\Http\Requests\UsuarioRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
     {  
	    $users =  User::all();
        return view('users.index', compact('users'));
    }

    public function create()    
    {
        $oficinas = Oficina::orderBy("denominacion")->get();
        $user     = (new User);
        $roles    = Role::orderBy('display_name', 'asc')->get();
        return view('users.create', compact('roles','user','oficinas'));
    }

    public function store(UserRequest $request)
    {
        $this->validate($request, ['password' => new UserPassword($request->reclave)]);
        $user = (new User);
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->attach($request->roles);
        return redirect()->route('users.index');
        
    }
    public function edit($user)
    {
        $oficinas = Oficina::orderBy("denominacion")->get();
        $user     = User::findOrFail($user);
        $roles    = Role::orderBy('display_name', 'asc')->get();
        return view('users.edit', compact('user', 'roles', 'oficinas'));
    }
    public function update(UserRequest $request, $id)
    {   
        $this->validate($request, ['password' => new UserPassword($request->reclave)]);

        $user = User::findOrFail($id);
        $pass = false;
        if($user->password != $request->password)
            $pass = true;
        $user->fill($request->all());
        if($pass)
            $user->password = Hash::make($request->password);
        $user->update();

        $user->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('info', 'Usuario actualizado');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('El usuario ha sido eliminada','info');
        return redirect()->route('users.index');
    }
}
