<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025001529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login ADD structure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB102534008B FOREIGN KEY (structure_id) REFERENCES structures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA08CB102534008B ON login (structure_id)');
        $this->addSql('ALTER TABLE structures ADD address VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB102534008B');
        $this->addSql('DROP INDEX UNIQ_AA08CB102534008B ON login');
        $this->addSql('ALTER TABLE login DROP structure_id');
        $this->addSql('ALTER TABLE structures DROP address');
    }
}
