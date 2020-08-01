<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\Http\Controllers\flash;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
    }

    /**
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $users=DB::table('users')->paginate(15); 
        return view('users.userList', ['users'=>$users]);
    }

    /**
     * @return \Illuminate\View\View
     */

    public function create(): \Illuminate\View\View
    {
        return view('users.create');
    }

    /**
     * @param User $user
     * @return \Illuminate\Routing\Redirector
     */
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


    /**
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(int $id): \Illuminate\View\View
    {
        $user=User::find($id);
        return view('users.details', compact('user'));
    }


    /**
     * @param User $user
     *@return  \Illuminate\View\View
     */
    public function edit(User $user): \Illuminate\View\View
    {
        return view('users.edit', compact('user'));
    }

/**
 * @param User $user
 * @param int $id
 * @return \Illuminate\Routing\Redirector
 */
    public function update(Request $request, int $id)
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
