<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027172122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE franchise (id INT AUTO_INCREMENT NOT NULL, login_id INT NOT NULL, city LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_66F6CE2A5CB2E05D (login_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login (id INT AUTO_INCREMENT NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structures (id INT AUTO_INCREMENT NOT NULL, franchise_id INT NOT NULL, login_id INT NOT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_5BBEC55A523CAB89 (franchise_id), UNIQUE INDEX UNIQ_5BBEC55A5CB2E05D (login_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE franchise ADD CONSTRAINT FK_66F6CE2A5CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55A523CAB89 FOREIGN KEY (franchise_id) REFERENCES franchise (id)');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55A5CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise DROP FOREIGN KEY FK_66F6CE2A5CB2E05D');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55A523CAB89');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55A5CB2E05D');
        $this->addSql('DROP TABLE franchise');
        $this->addSql('DROP TABLE login');
        $this->addSql('DROP TABLE structures');
    }
}
