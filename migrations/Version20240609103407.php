<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609103407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, locataire_id INT DEFAULT NULL, residence_id INT DEFAULT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, jours INT NOT NULL, prix_jour DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, INDEX IDX_42C84955D8A38199 (locataire_id), INDEX IDX_42C849558B225FBD (residence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558B225FBD FOREIGN KEY (residence_id) REFERENCES residence (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D8A38199');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558B225FBD');
        $this->addSql('DROP TABLE reservation');
    }
}
