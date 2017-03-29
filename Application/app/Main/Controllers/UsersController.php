<?php

namespace App\Main\Controllers;

use App\Main\Interfaces\IUser;
use Faker\Factory;

/**
 * Class UsersController
 * Manages RESTFul User data
 * @package App\Main\Controllers
 */
class UsersController extends Controller
{
    protected $faker;
    public function initialize(){
        $this->faker = Factory::create();
    }
    private function getUser(){
        $user = new IUser();
        $user->email = $this->faker->email;
        $user->name = $this->faker->name;
        $user->id = $this->faker->randomDigit;
        return $user;
    }

    /**
     * @return \Phalcon\Http\Response
     * @apiResponse IUser[]
     */
    public function get() {
        $data = [];
        for($i = 0; $i <= 20; $i++) {
            $data[] = $this->getUser();
        }
        return $this->jsonResponse($data);
    }

    /**
     * @return \Phalcon\Http\Response
     * @apiResponse IUser
     */
    public function getById() {
        return $this->jsonResponse($this->getUser());
    }

    /**
     * @apiResponse boolean
     */
    public function store(){}
    public function update(){}
    public function remove(){}
}
