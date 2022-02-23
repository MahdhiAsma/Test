<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220155430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, INDEX IDX_A532B4B519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien_equipement (lien_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_9054CEB5EDAAC352 (lien_id), INDEX IDX_9054CEB5806F0F5C (equipement_id), PRIMARY KEY(lien_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lien ADD CONSTRAINT FK_A532B4B519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE lien_equipement ADD CONSTRAINT FK_9054CEB5EDAAC352 FOREIGN KEY (lien_id) REFERENCES lien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lien_equipement ADD CONSTRAINT FK_9054CEB5806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lien DROP FOREIGN KEY FK_A532B4B519EB6921');
        $this->addSql('ALTER TABLE lien_equipement DROP FOREIGN KEY FK_9054CEB5806F0F5C');
        $this->addSql('ALTER TABLE lien_equipement DROP FOREIGN KEY FK_9054CEB5EDAAC352');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE lien');
        $this->addSql('DROP TABLE lien_equipement');
    }
}
