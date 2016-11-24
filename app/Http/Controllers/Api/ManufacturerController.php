<?php

namespace App\Http\Controllers\Api;

use App\Repository\Manufacturer\ManufacturerRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    private $manufacturer;

    public function __construct(ManufacturerRepo $repo)
    {
        $this->manufacturer = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->perpage;
        return $this->manufacturer->paginate($perpage);
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
        //return $request;
        $messages = [
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Mã nhà sản xuất đã tồn tại',
            'code.required' => 'Bạn chưa nhập mã hàng',
            'code.size' => 'Mã nhà sản xuất phải đúng 3 ký tự',
            'code.unique' => 'Mã nhà sản xuất đã tồn tại',
        ];
        $this->validate($request, [
            'name' => 'required|unique:manufacturers,name',
            'code' => 'required|size:3|unique:manufacturers,code',
        ], $messages);
        return $this->manufacturer->create($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->manufacturer->get($id);
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

        return $this->manufacturer->update($id, $request->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return $id == 0 ? $this->manufacturer->delete(request('ids')) :  $this->manufacturer->delete($id);
    }


}
