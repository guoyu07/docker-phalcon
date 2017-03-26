<?php

namespace Components\Console;

use Jenssegers\Blade\Blade;

class TypeScriptSdk extends Sdk
{
    protected $name = "sdk:typescript";
    protected $description = "Generate API sdk for TypeScript";
    protected $typescript_dir;
    /**
     * @var $blade Blade
     */
    protected $blade;

    protected function generate()
    {
        $this->typescript_dir = $this->getConfig()->adapter->TypeScriptSdk->directory;
        $this->dumpInterfaces($this->getInterfaces());
        $this->blade = new Blade([config()->path->views], '/tmp');
        // make routes
        // done.
//        var_dump($this->getRoutes());
        // get all the interfaces, let's write a few as an example.
//        var_dump($this->getConfig()->adapter->TypeScriptSdk);

//        $reflection = new \ReflectionClass($interfaces[0]);
//        $properties = $reflection->getProperties();
//        echo $properties[0]->getDocComment();

//        $table = $this->table(
//            ['Method', 'Path', 'Controller', 'Action', 'Assigned Name'],
//            $this->extractRoutes(Route::getRoutes())
//        );
    }

    /**
     * @param $interfaces array
     */
    protected function dumpInterfaces($interfaces)
    {
        $interface_definitions = array_map(function ($interface) {
            return $this->processInterface($interface);
        }, $interfaces);
        $blade = new Blade([config()->path->views], '/tmp');
        $interface_data = $blade->render("Sdk/TypeScript/interface", ['definitions' => $interface_definitions]);
        if (file_exists($this->typescript_dir)) {
            $this->dirRecursiveDel($this->typescript_dir);
        }
        mkdir($this->typescript_dir, 0777, true);
        file_put_contents($this->typescript_dir . 'interfaces.d.ts', $interface_data);
    }

    /**
     * @param $interface string
     * @return string
     */
    protected function processInterface($interface)
    {
        $public_properties = $this->getPublicProperties($interface);
        $properties = array_map(function ($property) {
            return $this->getPropertyInfo($property);
        }, $public_properties);
        $_ = explode("\\", $interface);
        $interface_without_namespace = end($_);
        $blade = new Blade([config()->path->views], '/tmp');

        return $blade->render(
            "Sdk/TypeScript/Partial/interface",
            ['interface' => $interface_without_namespace, 'properties' => $properties]
        );
    }

    /**
     * In php docs block, we can use integer, string and so on. This method should transform into equivalent.
     * For example, integer might become number in some languages
     * @param $type string
     * @return string
     */
    protected function transformTypes($type)
    {
        switch($type){
            case 'integer':
                return 'number';
            default:
                return $type;
        }
    }
}
