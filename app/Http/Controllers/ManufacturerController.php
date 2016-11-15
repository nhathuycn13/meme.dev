<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ManufacturerController extends Controller
{
    public function index()
    {
        return view('app.manufacturer');
    }
}
