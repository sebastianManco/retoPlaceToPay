<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view('businessManagement.index');
    }
}
