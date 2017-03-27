<?php

namespace App\Main\Controllers;

use App\Main\Interfaces\IUser;

class UsersController extends Controller
{
    /**
     * @return \Phalcon\Http\Response
     * @apiResponse IUser
     */
    public function get()
    {
        $user = new IUser();
        $user->email = 'gautam.nishchal@gmail.com';
        $user->name = 'Nishchal Gautam';
        return $this->jsonResponse($user);
    }
    public function store()
    {
        return ['method' => 'store'];
    }
}
