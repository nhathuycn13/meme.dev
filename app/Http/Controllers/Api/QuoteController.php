<?php

namespace App\Http\Controllers\Api;
use App\Mail\MyMail;
use App\Model\OrderType;
use App\Repository\Order\OrderRepo;
use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    private $quote;

    /**
     * @inheritDoc
     */
    public function __construct(OrderRepo $repo) {$this->quote = $repo; }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->quote->getAll(['1', '2']);
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
        return $this->quote->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->quote->get($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
            if ($this->quote->update($id, [
                'order_type_id' => 1,
            ])) return OrderType::find(1);
        }
        if ($request->setToQuote){
            if ($this->quote->update($id, [
                'order_type_id' => 2,
            ])) return OrderType::find(2);
        }
        if ($request->setToOrder){
            if ($this->quote->update($id, [
                'order_type_id' => 3,
            ])) return OrderType::find(3);
        }
        if ($request->sendMail){
            return $this->quote->sendMail($id, 1);
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
        return $this->quote->delete($id);
    }
}
