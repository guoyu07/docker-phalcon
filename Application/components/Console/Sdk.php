<?php
/**
 * Created by PhpStorm.
 * User: cyberhck
 * Date: 3/21/17
 * Time: 9:26 PM
 */

namespace Components\Console;


use Clarity\Console\Server\RoutesCommand;

abstract class Sdk extends RoutesCommand
{

    protected $name = "sdk";
    protected $description = "Generate Sdk for API";
    protected function getRoutes($routes)
    {
        return array_filter($routes, function($item){
            return $item !== null;
        });
    }
    /**
     * An function that will be called on every providers.
     */
    public function slash()
    {
        $this->generate();
    }
    protected function generate()
    {
        throw new \Exception('Implement a generate method');
    }
}
