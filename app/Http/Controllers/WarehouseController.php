<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('app.Nk.warehouse');
    }
}
