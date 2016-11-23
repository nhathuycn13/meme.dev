<?php

namespace App\Http\Controllers\Api;

use App\Repository\Product\ProductRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductRepo $repo)
    {
        $this->product = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return $this->product->paginate($request->perpage);
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
            'type_id.required' => 'Bạn chưa chọn loại',
            'manufacturer_id.required' => 'Bạn chưa chọn nhà sản xuất',
//            'thumbnail.image' => 'Ảnh không đúng',
        ];
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'type_id' => 'required',
            'manufacturer_id' => 'required',
//            'thumbnail' => 'image',
        ], $messages);
        return $this->product->create($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->product->get($id);
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

        ]);
        return $this->product->update($id, $request->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->product->delete($id);
    }

    public function search(Request $request)
    {
        return $this->product->search($request->keyword);
    }
}
