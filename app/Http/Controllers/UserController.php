<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Controllers\flash;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //funcion constructor es tan los middleware que se ejecutarán
    //validando que el usuario esté registarado y habilitado
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
    }

    /*hace visible la informacíon principal de los usuarios registrados en BD*/
    public function index()
    {
        $users=User::all();
        return view('users.userList', ['users'=>$users]);
    }

    //hace visible la vista para crear usuario de forma manual

    public function create()
    {
        return view('users.create');
    }

    //recibe el usuario que se crea de forma manual

    public function store(Request $request)
    {
            $user= new User();
            $user->name =request('name');
            $user->last_name =request('last_name');
            $user->email =request('email');
            $user->phone =request('phone');
            $user->password = Hash::make($request['password']);
            $user->save();
            $user->roles()->sync(Role::where('name', 'user')->first());
        return redirect('home/userList') ;
    }


    /*he empleado dos formas de traer los usuarios de la BD para mostrarlos en la interfaz.
    en la funcion show y en la funcion edit estan empleados ¿Cual es válido para usar?*/

    public function show($id)
    {
        $user=User::find($id);
        return view('users.details', compact('user'));
    }


    //se extraen los datos de un usuario específico
    // para mostrarlos en un formalario para ser actualizados

    public function edit(USer $user)
    {
        return view('users.edit', compact('user'));
    }

    //Actualizo la información del usuario y tambien
    //se puede modificar el estado del usuario

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name =$request->name;
        $user->last_name =$request->last_name;
        $user->email =$request->email;
        $user->phone =$request->phone;
        $user->estado = (!request()->has('estado') == '1' ? '0' : '1');
        $user->save();

        return redirect('/home/userList') ;
    }
}
