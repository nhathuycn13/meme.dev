<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 08/11/16
 * Time: 16:20
 */

namespace App\Repository\Order;


use App\Mail\QuoteMail;
use App\Model\Order;
use App\Model\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Mail;
use PDF;
use App;
class OrderEloquent implements OrderRepo
{
    private $order;

    public function __construct(Order $order)
    {
     $this->order = $order;
    }

    public function getAll($type = 0, $column = ['*'])
    {
        $result = $this->order;
        if ($type != 0 ){
            $result =  $result->whereIn('order_type_id', $type);
        }
        return $result->with('user', 'customer')->get($column);
    }

    public function create($attributes, $type = 2, $isOrder = false)
    {
        $attributes['customer_id'] = $attributes->customer_id['id'];
        $attributes['order_status'] = $type;
        $attributes['isOrder'] = $isOrder;
        $attributes['user_id'] = $attributes->user()->id;
        $meme = $this->order->create($attributes->toArray());
        foreach ($attributes->rows as $row){
            if($row['product_id'] > 0){
                $row['product_id'] = $row['product_id']['id'];
                $meme->OrderDetail()->save(new OrderDetail($row));
            }
        }
        return response($meme->id);
    }

    public function update($id, $attribute)
    {
        return $this->order->findOrFail($id)->update($attribute);
    }

    public function delete($id)
    {
        return $this->order->destroy($id);
    }

    public function get($id)
    {

        return $this->order->with('orderDetail.product', 'type', 'user', 'customer', 'products')->findOrFail($id);
    }

    public function sendMail($id, $type, $messageSend)
    {
        $data = $this->get($id);
        $order = $data['data'];
        switch ($type){
            case 1:
                $temp = Mail::to($messageSend['customer']);
                if (!empty($messageSend['cc'])) $temp = $temp->cc($messageSend['cc']);
                return $temp->send(new QuoteMail($data, $messageSend['content']));
        }
    }

    public function printMe($id, $type = 0)
    {
        $data = $this->get($id);
        $pdf = PDF::loadView('pdf.quote', $data);
        return $pdf->stream('quote.pdf');
    }

    public function paginate($perpage = 15, $isOrder = false, $column = ['*'])
    {
//        todoHuy: where orderStatus
        return $this->order->where('isOrder', $isOrder)->with(['customer', 'user'])->paginate($perpage, $column);
    }

    public function setStatus($id, $status)
    {
        $meme = $this->order->findOrFail($id);
        $meme->order_status = intval($status);
        if ($meme->save()){
            return App\Model\OrderStatus::find($status);
        }else return response('Error', 502);
    }


//    public function download($id, $type = 0)
//    {
//        $data = $this->get($id);
//        $pdf = PDF::loadView('pdf.quote', $data);
//        return $pdf->download('quote.pdf');
//    }
}