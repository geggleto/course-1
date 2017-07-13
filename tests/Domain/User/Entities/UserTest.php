<?php


namespace Tests\MyApp\Domain\User\Entities;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use MyApp\Core\ValueObjects\Uuid;
use MyApp\Domain\User\Entities\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function getEntityManager() {
        $config = Setup::createXMLMetadataConfiguration([DOCTRINE_XML_FOLDER], false);

        $cache = new \Doctrine\Common\Cache\ArrayCache();
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
        $config->setAutoGenerateProxyClasses(true);


        $dbConfig = include DOCTRINE_CONFIG_FILE;

        $entityManager = EntityManager::create($dbConfig, $config);
        $platform = $entityManager->getConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        return $entityManager;
    }

    public function testPersistence()
    {
        $password = bin2hex(random_bytes(8));
        $user = new User(
            new Uuid(),
            bin2hex(random_bytes(8)),
            $password,
            bin2hex(random_bytes(8))."@example.com"
        );

        $em = $this->getEntityManager();

        $em->persist($user);
        $em->flush();

        /** @var $foundUser User */
        $foundUser = $em->find(User::class, $user->getId()->toString());

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->getPassword(), $foundUser->getPassword());
    }
}