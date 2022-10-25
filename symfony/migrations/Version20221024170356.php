<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024170356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise DROP FOREIGN KEY FK_66F6CE2A79F37AE5');
        $this->addSql('DROP INDEX UNIQ_66F6CE2A79F37AE5 ON franchise');
        $this->addSql('ALTER TABLE franchise DROP id_user_id');
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB108486F9AC');
        $this->addSql('DROP INDEX UNIQ_AA08CB108486F9AC ON login');
        $this->addSql('ALTER TABLE login CHANGE adress_id address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB10F5B7AF75 FOREIGN KEY (address_id) REFERENCES structures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA08CB10F5B7AF75 ON login (address_id)');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55A71FDDEFB');
        $this->addSql('DROP INDEX IDX_5BBEC55A71FDDEFB ON structures');
        $this->addSql('ALTER TABLE structures DROP id_franchise_id, CHANGE adress address VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE franchise ADD CONSTRAINT FK_66F6CE2A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66F6CE2A79F37AE5 ON franchise (id_user_id)');
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_AA08CB10F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_AA08CB10F5B7AF75 ON login');
        $this->addSql('ALTER TABLE login CHANGE address_id adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_AA08CB108486F9AC FOREIGN KEY (adress_id) REFERENCES structures (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA08CB108486F9AC ON login (adress_id)');
        $this->addSql('ALTER TABLE structures ADD id_franchise_id INT NOT NULL, CHANGE address adress VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55A71FDDEFB FOREIGN KEY (id_franchise_id) REFERENCES franchise (id)');
        $this->addSql('CREATE INDEX IDX_5BBEC55A71FDDEFB ON structures (id_franchise_id)');
    }
}
