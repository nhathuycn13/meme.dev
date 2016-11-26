<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 29/10/16
 * Time: 09:56
 */

namespace App\Repository\PNK;


use App\Model\CTPNK;
use App\Model\NK_Status;
use App\Model\PNK;
use App\Model\Status;
use App\Model\Warehouse;
use App\User;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class PNKEloquent implements PNKrepo
{
    private $pnk, $ctpnk, $warehouse;

    public function __construct(PNK $p, CTPNK $CTPNK, Warehouse $warehouse)
    {
        $this->pnk = $p;
        $this->ctpnk = $CTPNK;
        $this->warehouse = $warehouse;
    }

    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->pnk->with('user')->with('status')->get($column);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create(Request $attributes)
    {
        $meme = $attributes->user()->PNKs()->save(new PNK($attributes->toArray()));
        $ctpnk = [];
        foreach ($attributes->rows as $row){
            if (($row['product_id']['id']) > 0)
            {
                $row['product_id'] = $row['product_id']['id'];
                $ctpnk[] = $row;
                $meme->CTPNKs()->save(new CTPNK($row));
            }else continue;
        }
        return response(route('nkManagement') + '#/view/' + $meme->id);
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        $e = PNK::findOrFail($id);
        $e->update($attribute);

        return $e;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->pnk->destroy($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return ($this->pnk->with('user', 'status', 'CTPNKs.product')->findOrFail($id));
    }

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($idPNK, $request)
    {
        $meme = $this->pnk->findOrFail($idPNK);
        if ($request->setStatus == 3){
            foreach ($meme->CTPNKs as $product) {
                $temp = $this->warehouse->where('product_id', $product->product_id)->where('price', $product->price)->first();
                if (isset($temp)){
                    $temp->update([
                        'qty' => $temp->qty + $product->qty,
                    ]);
                }else{
                    $this->warehouse->create($product->toArray());
                }
            }
        }
        $flag = $meme->update([
            'NK_status_id' => $request->setStatus,
        ]);
        if ($flag){
            return NK_Status::find($meme->NK_status_id);
        }else
            return response('Error', 502);
    }

    public function paginate($perpage, $column = ['*'])
    {
        return $this->pnk->with(['user', 'status'])->paginate($perpage, $column);
    }


}