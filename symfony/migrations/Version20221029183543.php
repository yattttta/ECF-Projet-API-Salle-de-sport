<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221029183543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permissions_list (id INT AUTO_INCREMENT NOT NULL, structures_id INT NOT NULL, drink_sales TINYINT(1) DEFAULT NULL, food_sales TINYINT(1) DEFAULT NULL, members_statistics TINYINT(1) DEFAULT NULL, members_subscriptions TINYINT(1) DEFAULT NULL, payment_schedules TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_BF04203D9D3ED38D (structures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE permissions_list ADD CONSTRAINT FK_BF04203D9D3ED38D FOREIGN KEY (structures_id) REFERENCES structures (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permissions_list DROP FOREIGN KEY FK_BF04203D9D3ED38D');
        $this->addSql('DROP TABLE permissions_list');
    }
}
