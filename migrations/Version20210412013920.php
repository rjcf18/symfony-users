<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412013920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create User Table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            "CREATE TABLE IF NOT EXISTS `user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`password` VARCHAR(64) NOT NULL COLLATE 'utf8_unicode_ci',
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
    UNIQUE INDEX email (email)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;"
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `user`');
    }
}
