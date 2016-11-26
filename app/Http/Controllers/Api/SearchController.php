<?php

namespace App\Http\Controllers\Api;

use App\Model\Customer;
use App\Model\Manufacturer;
use App\Model\PNK;
use App\Model\Product;
use App\Model\Type;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchType($query)
    {
        $id = intval($query);
        return Type::where('name', 'LIKE', "%$query%")
            ->orWhere('code', 'LIKE', "$query%")
            ->orWhere('id', 'LIKE', "$id%")->with('manufacturers')->get(['name', 'id', 'code']);
    }

    public function searchManufacturer($query)
    {
        $id = intval($query);
        return Manufacturer::where('name', 'LIKE', "%$query%")
            ->orWhere('code', 'LIKE', "$query%")
            ->orWhere('id', 'LIKE', "$id%")->get(['name', 'id', 'code']);
    }
    public function searchProduct($query)
    {
        $id = intval($query);
        return Product::where('name', 'LIKE', "%$query%")
            ->orWhere('code', 'LIKE', "$query%")
            ->orWhere('id', 'LIKE', "$id%")->get(['name', 'id', 'code']);
    }
    public function searchNK($query)
    {
        $id = intval($query);
        return PNK::where('id', 'LIKE', "%$query%")->get();
    }
    public function searchCustomer($query)
    {
        $id = intval($query);
        return Customer::where('name', 'LIKE', "%$query%")
            ->orWhere('phone', 'LIKE', "$query%")
            ->orWhere('mobile', 'LIKE', "$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->orWhere('company_name', 'LIKE', "%$query%")
            ->orWhere('id', 'LIKE', "$id%")->get(['name', 'id']);
    }
}
