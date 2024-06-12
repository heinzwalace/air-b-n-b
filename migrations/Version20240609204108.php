<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609204108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE locataire ADD residence_country_id INT DEFAULT NULL, DROP residence');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EB47C609EB FOREIGN KEY (residence_country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_C47CF6EB47C609EB ON locataire (residence_country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EB47C609EB');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP INDEX IDX_C47CF6EB47C609EB ON locataire');
        $this->addSql('ALTER TABLE locataire ADD residence VARCHAR(255) NOT NULL, DROP residence_country_id');
    }
}
