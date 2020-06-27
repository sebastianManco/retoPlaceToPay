<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\flash;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  
    public function index()
    {
        $users=User::all();
        return view('users.userList',['users'=>$users]);
    }


    public function create()
    {
       return view('users.create');
       
    }

    public function store(Request $request)
    {
        $user= new User();
        $user->name =request('name');
        $user->last_name =request('last_name');
        $user->email =request('email');
        $user->phone =request('phone');
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect('home/userList') ;

    }

    /*he empleado dos formas de traer los usuarios de la BD para mostrarlos en la interfaz
    en la funcion show y en la funcion edit estan empleados ¿Cual es válido para usar?*/

    public function show($id)
    {
      
        $user=User::find($id);
        return view('users.details', compact('user'));


    }


    public function edit(USer $usuario)
    {
        return view('users.edit', compact('usuario'));
    
    }
 
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name =$request->name;
        $user->last_name =$request->last_name;
        $user->email =$request->email;
        $user->phone =$request->phone;
        $user->estado = (!request()->has('estado') == '1' ? '0' : '1');
        $user->save();
        return redirect('home/userList') ;
    }


    public function destroy($id)
    {
        $users=User::findOrFail($id);

        $users->delete();

        return redirect('home/userList') ;
    }
    

 }
