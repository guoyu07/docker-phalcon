<?php

namespace Components\Console;


class TypeScriptSdk extends Sdk
{
    protected $name = "sdk:typescript";
    protected $description = "Generate API sdk for TypeScript";
    protected function generate()
    {
        foreach (di()->getServices() as $service) {

            if (! method_exists($def = $service->getDefinition(), 'afterModuleRun')) {
                continue;
            }
            $def->afterModuleRun();
        }
        var_dump($this->getRoutes($this->extractRoutes(Route::getRoutes())));
        // find all the interfaces, write them into index.d.ts

        $table = $this->table(
            ['Method', 'Path', 'Controller', 'Action', 'Assigned Name'],
            $this->extractRoutes(Route::getRoutes())
        );
    }
}
