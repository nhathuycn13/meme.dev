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
        return $this->nk->paginate(request('per_page'));
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
            'rows.required'    => 'Thêm sản phẩm.',
        ];
        $this->validate($request, [
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
        if ($request->has('setStatus')){
            return $this->nk->setStatus($id, $request);
        }

        //return $this->nk->update($id, $request->data);
    }

    public function destroy($id)
    {
        return $id == 0 ? $this->nk->delete(request('ids')) : $this->nk->delete($id);
    }
}
