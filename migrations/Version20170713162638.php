<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170713162638 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $users = $schema->createTable('users');
        $users->addColumn('id', 'guid');
        $users->setPrimaryKey(['id'],'users_pk');
        $users->addColumn('username', 'string', ['length' => 64, 'notnull' => true]);
        $users->addColumn('password', 'string', ['length' => 160, 'notnull' => true]);
        $users->addColumn('email', 'string', ['length' => 64, 'notnull' => true]);
        $users->addUniqueIndex(['email'], 'users_email_unqiue_index');
        $users->addUniqueIndex(['username'], 'users_username_unqiue_index');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('users');
    }
}
