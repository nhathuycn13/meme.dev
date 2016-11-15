<?php

namespace App\Http\Controllers\Api;

use App\Repository\Supplier\SupplierRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    private $supplier;

    public function __construct(SupplierRepo $repo)
    {
        $this->supplier = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->supplier->getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'data.name' => 'required',
            'data.tax_id' => 'required | digits:10',
            'data.email' => 'email',
            'data.company_name' => 'required',
            'data.phone' => 'numeric',
            'data.mobile' => 'numeric',

        ]);
        return $this->supplier->create($request->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->supplier->get($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.name' => 'required',
            'data.tax_id' => 'required | digits:10',
            'data.email' => 'email',
            'data.company_name' => 'required',
            'data.phone' => 'numeric',
            'data.mobile' => 'numeric',

        ]);
        return $this->supplier->update($id, $request->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->supplier->delete($id);
    }
}
