<?php
// Composer autoloading (PSR-0).
require_once __DIR__ . '/../vendor/autoload.php';
define("ROOT", __DIR__ . "/../");

use \Codito\Silex\Provider\ConsoleServiceProvider;
use \Codito\Silex\DoctrineMigrationsService\Provider\DoctrineMigrationsServiceProvider;
use \Silex\Provider\DoctrineServiceProvider;
use \Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use \Saxulum\DoctrineOrmManagerRegistry\Silex\Provider\DoctrineOrmManagerRegistryProvider;

$env = getenv('ENVIRONMENT');
if (!$env) {
    $env = 'local';
    putenv("ENVIRONMENT={$env}");
}

/**
 * PHP-DI Builder
 */
$builder = new DI\ContainerBuilder();
$builder->addDefinitions(__DIR__. '/di.config.php');
$builder->useAnnotations(true);
$builder->useAutowiring(true);

$app = new DI\Bridge\Silex\Application($builder);

/**
 * Silex Service Providers
 */
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new DoctrineOrmServiceProvider());
$app->register(new ConsoleServiceProvider());
$app->register(new DoctrineMigrationsServiceProvider());

/**
 * Configs Service Provider
 */
$pattern = sprintf(__DIR__. '/../config/{,*.}{global,%s,local}.php', $env);
$configs = glob($pattern, GLOB_BRACE);
foreach ($configs as $config) {
    $app->register(new Igorw\Silex\ConfigServiceProvider($config));
}

$app->register(new DoctrineOrmManagerRegistryProvider());

return $app;
