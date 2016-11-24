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

    public function create($attributes, $type = 2)
    {
        $order = $this->order->create([
            'customer_id' => $attributes->customer_id,
            'order_type_id' => $type,
            'shipping' => $attributes->shipping,
            'description' => $attributes->description,
            'payment_type_id' => $attributes->payment_type_id,
            'user_id' => Auth::user()->id,
        ]);
        foreach ($attributes->rows as $row){
            if($row['product_id'] > 0){
                $order->OrderDetail()->save(new OrderDetail($row));
            }
        }
        return $order->id;
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

        return [
            'data' => $this->order->with('orderDetail.product', 'type', 'user', 'customer', 'products')->findOrFail($id),
            'nextId' => $this->order->nextId($id),
            'previousId' => $this->order->previoustId($id),
        ];
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
//    public function download($id, $type = 0)
//    {
//        $data = $this->get($id);
//        $pdf = PDF::loadView('pdf.quote', $data);
//        return $pdf->download('quote.pdf');
//    }
}