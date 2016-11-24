<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 21/11/16
 * Time: 11:38
 */

namespace App\Repository\Profile;


interface ProfileRepo
{
    public function getProfile($id);
    public function updateProfile($id, $attributes);
    public function changePassword($id, $attributes);
}