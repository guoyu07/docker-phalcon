<?php
/**
 * Created by PhpStorm.
 * User: cyberhck
 * Date: 3/21/17
 * Time: 9:26 PM
 */

namespace Components\Console;

use Clarity\Console\Server\RoutesCommand;
use Clarity\Facades\Route;
use Phalcon\Di\Service;

abstract class Sdk extends RoutesCommand
{

    protected $name = "sdk";
    protected $description = "Generate Sdk for API";

    public function slash()
    {
        foreach (di()->getServices() as $service) {
            /**
             * @var $service Service
             */
            if (!method_exists($def = $service->getDefinition(), 'afterModuleRun')) {
                continue;
            }
            $def->afterModuleRun();
        }
        $this->generate();
    }

    protected function generate()
    {
        throw new \Exception('Implement a generate method');
    }

    protected function getInterfaces()
    {
        return array_map(function ($file) {
            return 'App\Main\Interfaces\\' . pathinfo(
                config()->path->app . 'Main/Interfaces/' . $file,
                PATHINFO_FILENAME
            );
        }, array_values(array_filter(scandir(config()->path->app . 'Main/Interfaces'), function ($item) {
            return $item !== '.' && $item != '..';
        })));
    }

    protected function getConfig()
    {
        return config()->sdk;
    }

    protected function getRoutes()
    {
        $routes = $this->extractRoutes(Route::getRoutes());
        return array_filter($routes, function ($item) {
            return $item !== null;
        });
    }
}
