<?php
/**
 * Created by PhpStorm.
 * User: cyberhck
 * Date: 3/21/17
 * Time: 9:26 PM
 */

namespace Components\Console;


use Clarity\Console\Brood;

class Sdk extends Brood
{

    protected $name = "sdk";
    protected $description = "Generate Sdk for API";
    /**
     * An function that will be called on every providers.
     */
    public function slash()
    {
        echo "slash \n";
    }
}