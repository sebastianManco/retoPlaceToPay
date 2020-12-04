<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class businessManagementController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view('businessManagement.index');
    }
}
