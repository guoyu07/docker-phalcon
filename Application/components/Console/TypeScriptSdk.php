<?php

namespace Components\Console;

class TypeScriptSdk extends Sdk
{
    protected $name = "sdk:typescript";
    protected $description = "Generate API sdk for TypeScript";
    protected function generate()
    {
        $interfaces = $this->getInterfaces();
//        var_dump($this->getRoutes());
        // get all the interfaces, let's write a few as an example.
        var_dump($this->getConfig()->adapter->TypeScriptSdk);

//        $reflection = new \ReflectionClass($interfaces[0]);
//        $properties = $reflection->getProperties();
//        echo $properties[0]->getDocComment();

//        $table = $this->table(
//            ['Method', 'Path', 'Controller', 'Action', 'Assigned Name'],
//            $this->extractRoutes(Route::getRoutes())
//        );
    }
}
