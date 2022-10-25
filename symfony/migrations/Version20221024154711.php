<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024154711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB108486F9AC FOREIGN KEY (adress_id) REFERENCES structures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA08CB108486F9AC ON login (adress_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB108486F9AC');
        $this->addSql('DROP INDEX UNIQ_AA08CB108486F9AC ON login');
        $this->addSql('ALTER TABLE login DROP adress_id');
    }
}
