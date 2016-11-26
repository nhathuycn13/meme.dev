<?php

namespace App\Http\Controllers\Api;

use App\Repository\Type\TypeRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Psy\Util\Json;

class TypeController extends Controller
{
    private $type;

    public function __construct(TypeRepo $repo)
    {
        $this->type = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->type->paginate(request('perpage'));
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
        $messages = [
            'name.required' => 'Bạn chưa nhập tên',
            'code.required' => 'Bạn chưa nhập mã hàng',
            'code.size' => 'Mã loại sản phẩm phải đúng 3 ký tự',
            'code.unique' => 'Mã loại sản phẩm đã tồn tại',
        ];
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|size:3|unique:manufacturers,code',
        ], $messages);
        return $this->type->create($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->type->get($id);
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
        ]);
        return $this->type->update($id, $request->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id == 0? $this->type->delete(request('ids')) : $this->type->delete($id);
    }
}
