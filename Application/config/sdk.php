<?php
$generation_dir = __DIR__ . '/../../build/sdk';
return [
    'generate_dir' => $generation_dir,
    'adapter' => [
        'TypeScriptSdk' => [
            'directory' => $generation_dir . '/typescript',
            // some additional config
        ]
    ]
];