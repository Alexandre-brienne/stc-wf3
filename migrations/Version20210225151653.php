<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225151653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, ADD sexe VARCHAR(255) NOT NULL, ADD point INT DEFAULT NULL, ADD date_inscription DATETIME NOT NULL, ADD date_naissance DATE NOT NULL, ADD date_connexion DATETIME DEFAULT NULL, ADD recherche VARCHAR(255) DEFAULT NULL, ADD situation VARCHAR(255) DEFAULT NULL, ADD profession VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, ADD dapartement VARCHAR(255) DEFAULT NULL, ADD image_fond VARCHAR(255) DEFAULT NULL, ADD taille INT DEFAULT NULL, ADD cheveux VARCHAR(255) DEFAULT NULL, ADD astrologique VARCHAR(255) DEFAULT NULL, ADD amis_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP email, DROP sexe, DROP point, DROP date_inscription, DROP date_naissance, DROP date_connexion, DROP recherche, DROP situation, DROP profession, DROP ville, DROP dapartement, DROP image_fond, DROP taille, DROP cheveux, DROP astrologique, DROP amis_id');
    }
}
