<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225160539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ami (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, valid INT DEFAULT NULL, amis_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, item_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(45) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, expediteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, message LONGTEXT DEFAULT NULL, date_envoi DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profils_categories (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, categorie_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, categorie_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, point INT DEFAULT NULL, date_inscription DATETIME NOT NULL, date_naissance DATE NOT NULL, date_connexion DATETIME DEFAULT NULL, recherche VARCHAR(255) DEFAULT NULL, situation VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, dapartement VARCHAR(255) DEFAULT NULL, image_fond VARCHAR(255) DEFAULT NULL, taille INT DEFAULT NULL, cheveux VARCHAR(255) DEFAULT NULL, astrologique VARCHAR(255) DEFAULT NULL, amis_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ami');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE profils_categories');
        $this->addSql('DROP TABLE sous_categories');
        $this->addSql('DROP TABLE user');
    }
}
