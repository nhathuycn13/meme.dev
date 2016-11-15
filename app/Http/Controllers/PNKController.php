<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PNKController extends Controller
{
    public function index()
    {
        return view('app.PNK');
    }

    public function getCTPNK()
    {
        return view('app.Nk.create');
    }

    public function postCTPNK()
    {
        
    }
}
