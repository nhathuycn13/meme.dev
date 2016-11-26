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
    public function index(Request $request)
    {
        $perpage = $request->perpage;
        return $this->supplier->paginate($perpage);
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
        // viet hoa
        $messages = [
            'name.required' => 'Bạn chưa nhập tên',
            'tax_id.required' => 'Bạn chưa nhập mã số thuế',
            'tax_id.digits' => 'Mã số thuế không đúng',
            'email.email' => 'Email không đúng',
            'email.unique' => 'Email không đúng',
            'company_name.required' => 'Bạn chưa nhập tên công ty',
        ];
        $this->validate($request, [
            'name' => 'required',
            'tax_id' => 'required|digits:10',
            'email' => 'email|unique:supliers,email',
            'company_name' => 'required',
        ], $messages);
        return $this->supplier->create($request->toArray());
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
        // viet hoa email
        $messages = [
            'name.required' => 'Bạn chưa nhập tên',
            'tax_id.required' => 'Bạn chưa nhập mã số thuế',
            'tax_id.digits' => 'Mã số thuế không đúng',
            'email.email' => 'Email không đúng',
            'email.unique' => 'Email không đúng',
            'company_name.required' => 'Bạn chưa nhập tên công ty',
        ];
        $this->validate($request, [
            'name' => 'required',
            'tax_id' => 'required | digits:10',
            'email' => 'email|unique:supliers,email',
            'company_name' => 'required',
        ], $messages);
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
        return $id == 0 ? $this->supplier->delete(request('ids')) : $this->supplier->delete($id);
    }
}
