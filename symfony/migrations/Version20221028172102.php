<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221028172102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permissions_list (id INT AUTO_INCREMENT NOT NULL, drink_sales TINYINT(1) NOT NULL, food_sale TINYINT(1) NOT NULL, members_statistics TINYINT(1) NOT NULL, members_subscription TINYINT(1) NOT NULL, payment_schedules TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE structures ADD permissions_list_id INT NOT NULL');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55AD81B53F7 FOREIGN KEY (permissions_list_id) REFERENCES permissions_list (id)');
        $this->addSql('CREATE INDEX IDX_5BBEC55AD81B53F7 ON structures (permissions_list_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55AD81B53F7');
        $this->addSql('DROP TABLE permissions_list');
        $this->addSql('DROP INDEX IDX_5BBEC55AD81B53F7 ON structures');
        $this->addSql('ALTER TABLE structures DROP permissions_list_id');
    }
}
