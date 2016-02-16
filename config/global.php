<?php
return [
    "debug" => true,
    'console.name' => 'GraPHP',
    'console.version' => '0.0.1',
    'console.project_directory' => __DIR__ . '/..',
    'console.commands' => function() {
        $commands[] = new \Command\ImportCommand();
        $commands[] = new \Command\QueryCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\GenerateCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\MigrateCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\DiffCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\LatestCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\ExecuteCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\StatusCommand();
        $commands[] = new \Codito\Silex\DoctrineMigrationsService\Console\Command\VersionCommand();

        return $commands;
    },
    'orm.proxies_dir' => __DIR__.'/../data/DoctrineORMModule/Proxy',
    'orm.auto_generate_proxies' => true,
    'orm.em.options' => [
        'mappings' => [
            [
                'type' => 'annotation',
                'namespace' => 'Entity',
                'path' => __DIR__.'/../src/Entity',
                'use_simple_annotation_reader' => false,
            ],
        ],
    ],
    'db.migrations.options' =>  [
        'default' => [
            'dir_name' => __DIR__ . '/../data/DoctrineORMModule/Migrations',
            'namespace' => 'Migrations',
            'table_name' => 'gp_migrations',
            'name' => 'GraphP Migrations'
        ]
    ]
];
