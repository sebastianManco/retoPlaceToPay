<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Http\RedirectResponse;
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
        $users = DB::table('users')->paginate(10);
        return view('users.userList', ['users' => $users]);
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
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        $this->storeUpdateUser($request, new User());

        return redirect('home/userList');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $user = User::findOrFail($id);

        return view('users.details', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return  View
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        $this->storeUpdateUser($request, $user);

        return redirect('home/userList') ;
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    private function storeUpdateUser(Request $request, User $user): User
    {
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->estado = (!request()->has('estado') == '1' ? '0' : '1');
        $user->password = Hash::make($request['password']);
        $user->save();

        Cache::put('user.' . $user->id, $user, 6000);
        $user->roles()->sync(Role::where('name', 'user')->first());

        return $user;
    }
}
