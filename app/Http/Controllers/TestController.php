<?php

namespace App\Http\Controllers;

use App\Model\Permission;
use App\Model\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Auth;

class TestController extends Controller
{
    public function __construct()
    {


    }
    public function index()
    {
        $user = auth()->user();
//        dd($user->can('delete', User::class));
        dd(Gate::allows('user-management'));
    }

}
