<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719080258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, restaurant_id_id INT DEFAULT NULL, avis_id_id INT DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, rating VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8F91ABF09D86650F (user_id_id), INDEX IDX_8F91ABF035592D86 (restaurant_id_id), INDEX IDX_8F91ABF088C1F29 (avis_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, ville_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_EB95123FF0C17188 (ville_id_id), INDEX IDX_EB95123F9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_picture (id INT AUTO_INCREMENT NOT NULL, restaurant_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) DEFAULT NULL, INDEX IDX_DC9013FC35592D86 (restaurant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, ville_id_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649F0C17188 (ville_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF09D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF035592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF088C1F29 FOREIGN KEY (avis_id_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FF0C17188 FOREIGN KEY (ville_id_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE restaurant_picture ADD CONSTRAINT FK_DC9013FC35592D86 FOREIGN KEY (restaurant_id_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F0C17188 FOREIGN KEY (ville_id_id) REFERENCES ville (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF09D86650F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF035592D86');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF088C1F29');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FF0C17188');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F9D86650F');
        $this->addSql('ALTER TABLE restaurant_picture DROP FOREIGN KEY FK_DC9013FC35592D86');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F0C17188');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_picture');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
