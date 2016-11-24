<?php

namespace App\Http\Controllers\Api;

use App\Model\Manufacturer;
use App\Model\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchType($query)
    {
        $id = intval($query);
        return Type::where('name', 'LIKE', $query)
            ->orWhere('code', 'LIKE', "$query%")
            ->orWhere('id', 'LIKE', "$id%")->get(['name', 'id', 'code']);
    }

    public function searchManufacturer($query)
    {
        $id = intval($query);
        return Manufacturer::where('name', 'LIKE', $query)
            ->orWhere('code', 'LIKE', "$query%")
            ->orWhere('id', 'LIKE', "$id%")->get(['name', 'id', 'code']);
    }
}
