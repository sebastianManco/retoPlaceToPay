<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
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
        $users=DB::table('users')->paginate(10);
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
     * @param UserCreateRequest $request
     * @return Redirector
     */
    //UserCreateRequest $request

    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);
        Cache::put('user.' . $user->id, $user, 6000);
        UserCreated::dispatch($user, auth()->user());
        $user->roles()->sync(Role::where('name', 'user')->first());
        return redirect('home/userList');


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
        $user->save();

        return redirect('home/userList') ;
    }
}
