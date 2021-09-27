<?php 

return [
    'array' => [
        'class' => \ahmetbarut\Translation\Loader\ArrayLoader::class
    ],

    'json' => [
        'class' => \ahmetbarut\Translation\Loader\JsonLoader::class
    ],
    'db' => [
        'class' => \ahmetbarut\Translation\Loader\DatabaseLoader::class
    ]
];