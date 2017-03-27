<?php

namespace App\Main\Controllers;

use Clarity\Support\Phalcon\Mvc\Controller as BaseController;
use Phalcon\Http\Response;

class Controller extends BaseController
{
    /**
     * @param $jsonData
     * @return Response
     */
    protected function jsonResponse($jsonData)
    {
        return (new Response())->setJsonContent($jsonData);
    }
}
