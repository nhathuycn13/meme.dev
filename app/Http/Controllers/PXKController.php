<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PXKController extends Controller
{
    public function index()
    {
        return view('app.PXK');
    }
}
