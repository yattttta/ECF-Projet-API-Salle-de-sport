<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221020163634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE franchise (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, city LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_66F6CE2A79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structures (id INT AUTO_INCREMENT NOT NULL, id_franchise_id INT NOT NULL, adress VARCHAR(255) NOT NULL, INDEX IDX_5BBEC55A71FDDEFB (id_franchise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE franchise ADD CONSTRAINT FK_66F6CE2A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55A71FDDEFB FOREIGN KEY (id_franchise_id) REFERENCES franchise (id)');
        $this->addSql('ALTER TABLE login CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise DROP FOREIGN KEY FK_66F6CE2A79F37AE5');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55A71FDDEFB');
        $this->addSql('DROP TABLE franchise');
        $this->addSql('DROP TABLE structures');
        $this->addSql('ALTER TABLE login CHANGE roles roles VARCHAR(100) DEFAULT NULL');
    }
}
