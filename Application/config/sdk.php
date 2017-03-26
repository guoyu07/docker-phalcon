<?php
$generation_dir = config('path.root') . 'build/';
return [
    'generate_dir' => $generation_dir,
    'adapter' => [
        'TypeScriptSdk' => [
            'directory' => $generation_dir . 'typescript/',
            // some additional config
        ]
    ]
];
