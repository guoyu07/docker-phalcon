<?php
namespace App\Main\Interfaces;

class IUser{
    /**
     * @var $name string|null
     */
    public $name;
    /**
     * @var $email string|null
     */
    public $email;
}

$reflection = new \ReflectionClass(IUser::class);
$properties = $reflection->getProperties();
echo $properties[0]->getDocComment();
// var_dump($properties);

