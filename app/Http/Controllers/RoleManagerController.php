<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RoleManagerController extends Controller
{
    public function index()
    {
        return view('app.roleManagement');
    }
}
