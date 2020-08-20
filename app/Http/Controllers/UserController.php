<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\Http\Controllers\flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $users=DB::table('users')->paginate(15);
        return view('users.userList', ['users'=>$users]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('users.create', ['user' => new User()]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Redirector
     */
    //UserCreateRequest $request

    public function store(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ], [
            'name.required' =>  'El campo es obligatorio',
            'last_name.required' => 'El campo es obligatorio',

        ]);

        User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['name'])
        ]);
        return redirect('home/userList');

         /*$user= new User();
         $user->name = $request->input('name');
         $user->last_name = $request->input('last_name');
         $user->email = $request->input('email');
         $user->phone = $request->input('phone');
         $user->password = Hash::make($request['password']);
         $user->save();
         $user->roles()->sync(Role::where('name', 'user')->first());
         */

    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $user=User::find($id);
        return view('users.details', compact('user'));
    }

    /**
     * @param User $user
     *@return  View
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Request $request
     * @param User $user
     * @param int $id
     * @param Request $request
     */
    public function update(User $user,  Request $request)
    {
        $user->name =$request->name;
        $user->last_name =$request->last_name;
        $user->email =$request->email;
        $user->phone =$request->phone;
        $user->estado = (!request()->has('estado') == '1' ? '0' : '1');
        $user->password = Hash::make($request['password']);
        $user->update();

        return redirect('home/userList') ;
    }
}
