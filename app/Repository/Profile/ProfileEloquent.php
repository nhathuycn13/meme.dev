<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 21/11/16
 * Time: 11:39
 */

namespace App\Repository\Profile;


use App\User;

class ProfileEloquent implements ProfileRepo
{
    private $profile;

    public function getProfile($id)
    {
        return $this->profile->findOrFail($id);
    }

    public function updateProfile($id, $attributes)
    {
        $meme = $this->profile->findOrFail($id);
        return $meme->update($attributes);
    }

    public function changePassword($id, $attributes)
    {
        $meme = $this->profile->findOrFail($id);
        return $meme->update($attributes);
    }

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @return void
     * @link http://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct(User $user) {$this->profile = $user; }


}