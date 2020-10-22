<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class businessManagementController extends Controller
{
    public function index()
    {
        return view('businessManagement.index');
    }
}
