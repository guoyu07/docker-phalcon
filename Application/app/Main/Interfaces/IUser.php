<?php
namespace App\Main\Interfaces;

class IUser
{
    /**
     * @var $id integer
     * @optional
     */
    public $id;
    /**
     * @var $email string
     */
    public $email;
    /**
     * @var $name string
     */
    public $name;
}
