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

    /**
     * Gets public properties of a class
     * @param $className string
     * @return \ReflectionProperty[]
     */
    protected function getPublicProperties($className)
    {
        $reflection = new \ReflectionClass($className);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
        return $properties;
    }

    /**
     * Gets information about a property inside a class
     * @param $property \ReflectionProperty
     * @return array
     */
    protected function getPropertyInfo(\ReflectionProperty $property)
    {
        $docs_block = $property->getDocComment();
        $matches = [];
        preg_match_all("/@var (\\$\\w+) (\\w+)/", $docs_block, $matches);
        $property_name = $matches[1][0];
        $property_type = $this->transformTypes($matches[2][0]);
        // if convert php docs into typescript
        $optional = preg_match('/@optional/', $docs_block);
        return ['name' => $property_name, 'type' => $property_type, 'optional' => $optional];
    }

    /**
     * In php docs block, we can use integer, string and so on. This method should transform into equivalent.
     * For example, integer might become number in some languages
     * @param $type string
     * @return string
     */
    abstract protected function transformTypes($type);

    protected function dirRecursiveDel($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->dirRecursiveDel("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
