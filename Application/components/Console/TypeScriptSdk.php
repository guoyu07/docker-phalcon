<?php

namespace Components\Console;

use Jenssegers\Blade\Blade;

class TypeScriptSdk extends Sdk
{
    protected $name = "sdk:typescript";
    protected $description = "Generate API sdk for TypeScript";
    protected $typescript_dir;

    protected function generate()
    {
        $this->typescript_dir = $this->getConfig()->adapter->TypeScriptSdk->directory;
        $this->dumpInterfaces($this->getInterfaces());
        foreach ($this->array_group($this->getRoutes(), 'controller') as $controller => $group) {
            $this->makeApi($controller, $group);
            // todo $reflectionClass->getDocComment(); // generate Docs too
        }
        $blade = new Blade([config()->path->views], '/tmp');
        //  todo base_url
        $base_url = 'localhost:8080/';
        $base_api = $blade->render('Sdk/TypeScript/BaseApi', ['base_url' => $base_url]);
        file_put_contents($this->typescript_dir . 'BaseApi.ts', $base_api);
        // get all the routes
        // group by controller
        // create a controllerApi class
        // declare a public <method> class
        // make sure about the return types.
        // make routes
        // done.
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

    private function array_group($array, $group_by)
    {
        $result = array();
        foreach ($array as $data) {
            $item = $data[$group_by];
            if (isset($result[$item])) {
                $result[$item][] = $data;
            } else {
                $result[$item] = array($data);
            }
        }

        return $result;
    }

    protected function makeApi($controller_name, $routes)
    {
        $reflection = new \ReflectionClass('\\App\\Main\\Controllers\\' . $controller_name . 'Controller');
        $data = array_map(function ($route) use ($reflection) {
            return array_merge($this->getMethodInformation($reflection->getMethod($route['action'])),
                ['url' => $route['path'], 'method' => $route['method']]);
        }, $routes);
        $blade = new Blade([config()->path->views], '/tmp');
        $controller_api = $blade->render("Sdk/TypeScript/api", ['ControllerName' => $controller_name, 'methods' => $data]);
        file_put_contents($this->typescript_dir . $controller_name . 'Api.ts', $controller_api);
    }

    protected function getMethodInformation(\ReflectionMethod $method)
    {
        $matches = [];
        $doc_block = $method->getDocComment();
        preg_match('/@apiResponse (.+)/', $doc_block, $matches);
        // var_dump($matches);
        $returns = $matches[1];

        // todo maybe get description so we can generate documentation too
        return ['response' => $returns, 'action' => $method->name];
    }

    /**
     * In php docs block, we can use integer, string and so on. This method should transform into equivalent.
     * For example, integer might become number in some languages
     * @param $type string
     * @return string
     */
    protected function transformTypes($type)
    {
        switch ($type) {
            case 'integer':
                return 'number';
            default:
                return $type;
        }
    }
}
