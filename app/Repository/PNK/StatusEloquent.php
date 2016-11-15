<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 02/11/16
 * Time: 17:45
 */

namespace App\Repository\PNK;


use App\Model\Status;

class StatusEloquent implements StatusRepo
{
    private $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function getAll()
    {
        return $this->status->all();
    }
}