<?php

namespace App\Http\Controllers\Api;

use App\Model\OrderType;
use App\Repository\Order\OrderRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $order;

    public function __construct(OrderRepo $repo)
    {
        $this->order = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all orders with status order and done!!!
        $columns = ['id'];
        return $this->order->getAll(['3', '4']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

        ];
        $message = [

        ];
        $this->validate($request, $rules, $message);
        return $this->order->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->order->get($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->order->printMe($id);
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
        if ($request->setToCancel){
            if ($this->order->update($id, [
                'order_type_id' => 1,
            ])) return OrderType::find(1);
        }
        if ($request->setToQuote){
            if ($this->order->update($id, [
                'order_type_id' => 2,
            ])) return OrderType::find(2);
        }
        if ($request->setToOrder){
            if ($this->order->update($id, [
                'order_type_id' => 3,
            ])) return OrderType::find(3);
        }
        if ($request->sendMail){
            return $this->order->sendMail($id, 1, $request->data);
        }
        if ($request->printMe){
            return $this->order->printMe($id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->order->delete($id);
    }
}
