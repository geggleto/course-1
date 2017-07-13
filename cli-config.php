<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Common\ClassLoader;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\Tools\Setup;

/** @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = null;

$config = Setup::createXMLMetadataConfiguration([__DIR__ . '/config/Xml'], false);

$cache = new \Doctrine\Common\Cache\ArrayCache();
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);
$config->setAutoGenerateProxyClasses(true);


$dbConfig = include __DIR__ . "/config/doctrine.php";

$entityManager = EntityManager::create($dbConfig, $config);
$platform = $entityManager->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

//Load the Migrations bundle
$classLoader = new ClassLoader('Doctrine\DBAL\Migrations', __DIR__.'vendor/doctrine/migrations/lib');
$classLoader->register();

$configuration = new Configuration($entityManager->getConnection());
$configuration->setMigrationsDirectory('migrations');
$configuration->setMigrationsNamespace('Migrations');
$configuration->setMigrationsTableName('app_migrations');


$diff = new DiffCommand();
$exec = new ExecuteCommand();
$gen = new GenerateCommand();
$migrate = new MigrateCommand();
$status = new StatusCommand();
$ver = new VersionCommand();

$diff->setMigrationConfiguration($configuration);
$exec->setMigrationConfiguration($configuration);
$gen->setMigrationConfiguration($configuration);
$migrate->setMigrationConfiguration($configuration);
$status->setMigrationConfiguration($configuration);
$ver->setMigrationConfiguration($configuration);


$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($entityManager->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager),
    'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper()
));

$cli = ConsoleRunner::createApplication($helperSet,[
    $diff, $exec, $gen, $migrate, $status, $ver
]);

return $cli->run();



