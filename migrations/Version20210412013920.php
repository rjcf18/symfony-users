<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210412013920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create User Table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('user');

        $table->addColumn(
            'id',
            'integer',
            [
                'autoincrement' => true,
                'notnull' => true,
            ]
        );
        $table->setPrimaryKey(['id']);

        $table->addColumn(
            'name',
            'string',
            [
                'notnull' => true,
                'length' => 255,
            ]
        );

        $table->addColumn(
            'email',
            'string',
            [
                'notnull' => true,
                'length' => 255,
            ]
        );

        $table->addColumn(
            'password',
            'string',
            [
                'notnull' => true,
                'length' => 64,
            ]
        );

        $table->addColumn(
            'created_at',
            'datetime',
            [
                'notnull' => true,
                'default' => "CURRENT_TIMESTAMP"
            ]
        );

        $table->addColumn(
            'updated_at',
            'datetime',
            [
                'notnull' => true,
                'default' => "CURRENT_TIMESTAMP"
            ]
        );

        $table->addUniqueIndex(['email'], 'user_email_unique');
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('user');
    }
}
