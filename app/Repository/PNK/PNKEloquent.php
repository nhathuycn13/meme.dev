<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 29/10/16
 * Time: 09:56
 */

namespace App\Repository\PNK;


use App\Model\CTPNK;
use App\Model\PNK;
use App\Model\Status;
use App\User;
use Auth;
class PNKEloquent implements PNKrepo
{
    private $pnk, $ctpnk, $warehouse;

    public function __construct(PNK $p, CTPNK $CTPNK)
    {
        $this->pnk = $p;
        $this->ctpnk = $CTPNK;
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
    public function create($attributes)
    {
        $user = User::find($attributes->user()->id);
        $pnk = $user->PNKs()->save(new PNK([
            'status_id' => $attributes->status_id,
            'tax' => $attributes->tax,
            'shipping' => $attributes->shipping,
            'description' => $attributes->description,
        ]));
        foreach ($attributes->rows as $row){
            if (($row['product_id']) > 0)
            {
                $pnk->CTPNKs()->save(new CTPNK($row));
            }else continue;
        }
        return route('nkManagement') + '#/view/' + $pnk->id;
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
        return ($this->pnk->with('user', 'status', 'CTPNKs', 'products')->findOrFail($id));
    }

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($idPNK, $status)
    {
        $flag = $this->pnk->findOrFail($idPNK);
        $flag->status_id = $status;
        if ($status == 3){
            $this->nk();
        }
        if ($flag->save()){
            return Status::find($status);
        }
    }

    public function nk()
    {

    }
}