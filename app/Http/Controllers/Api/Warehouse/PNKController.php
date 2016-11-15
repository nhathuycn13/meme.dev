<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Repository\PNK\PNKrepo;
use App\Repository\Warehouse\WarehouseRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PNKController extends Controller
{
    private $nk, $warehouse;

    public function __construct(PNKrepo $krepo, WarehouseRepo $warehouseRepo)
    {
        $this->nk = $krepo;
        $this->warehouse = $warehouseRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->nk->getAll();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'status_id.required' => 'Vui lòng chọn trạng thái.',
            'tax.numeric' => 'Vui lòng nhập số thích hợp.',
            'tax.min' => 'Vui lòng nhập số lớn hơn hoặc bằng :min.',
            'tax.max' => 'Vui lòng nhập số nhỏ hơn hoặc bằng :max.',
            'shipping.numeric' => 'Vui lòng nhập số thích hợp.',
            'shipping.min' => 'Vui lòng nhập số lớn hơn hoặc bằng :min.',
            'rows.required'    => 'Thêm sản phẩm.',
        ];
        $this->validate($request, [
            'status_id' => 'required',
            'tax'       => 'numeric|min:0|max:100',
            'shipping'       => 'numeric|min:0',
            'rows'      => 'required',
        ], $message);
        return $this->nk->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->nk->get($id);
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
        //change status to done!!!
        if ($request->setToDone){
            $this->warehouse->create($id);
            return $this->nk->setStatus($id, 3);
        }
        if ($request->setToPending){
            return $this->nk->setStatus($id, 2);
        }
        if ($request->setToCancel){
            return $this->nk->setStatus($id, 4);
        }
        return $this->nk->update($id, $request->data);
    }

    public function destroy($id)
    {
        return $this->nk->delete($id);
    }
}
