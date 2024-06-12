<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611180257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, residence_country_id INT DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, age INT DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_C47CF6EB47C609EB (residence_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, locataire_id INT NOT NULL, residence_id INT NOT NULL, start DATETIME DEFAULT NULL, end DATETIME DEFAULT NULL, day_price DOUBLE PRECISION NOT NULL, total_price DOUBLE PRECISION DEFAULT NULL, days INT DEFAULT NULL, INDEX IDX_5E9E89CBD8A38199 (locataire_id), INDEX IDX_5E9E89CB8B225FBD (residence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, locataire_id INT DEFAULT NULL, residence_id INT DEFAULT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, nb_jours INT NOT NULL, prix_jour DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, is_paid TINYINT(1) NOT NULL, INDEX IDX_42C84955D8A38199 (locataire_id), INDEX IDX_42C849558B225FBD (residence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE residence (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, rooms INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EB47C609EB FOREIGN KEY (residence_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBD8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB8B225FBD FOREIGN KEY (residence_id) REFERENCES residence (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558B225FBD FOREIGN KEY (residence_id) REFERENCES residence (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EB47C609EB');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBD8A38199');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB8B225FBD');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D8A38199');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558B225FBD');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE residence');
        $this->addSql('DROP TABLE user');
    }
}
