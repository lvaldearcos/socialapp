<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131190421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE follow (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liked (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, message VARCHAR(1000) NOT NULL, image VARCHAR(500) DEFAULT NULL, file VARCHAR(500) DEFAULT NULL, leido TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, leido TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publications (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, description VARCHAR(500) NOT NULL, image VARCHAR(500) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_32783AF438B217A7 (publication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, publications_id INT DEFAULT NULL, followers_id INT DEFAULT NULL, following_id INT DEFAULT NULL, likes_id INT DEFAULT NULL, emitter_id INT DEFAULT NULL, received_id INT DEFAULT NULL, notifications_id INT DEFAULT NULL, role VARCHAR(50) NOT NULL, nombre VARCHAR(150) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, passw VARCHAR(100) NOT NULL, username VARCHAR(100) NOT NULL, description VARCHAR(500) NOT NULL, image VARCHAR(500) NOT NULL, INDEX IDX_2265B05DAFFB3979 (publications_id), INDEX IDX_2265B05D15BF9993 (followers_id), INDEX IDX_2265B05D1816E3A3 (following_id), INDEX IDX_2265B05D2F23775F (likes_id), INDEX IDX_2265B05D37BC4DC6 (emitter_id), INDEX IDX_2265B05DB821E5F5 (received_id), INDEX IDX_2265B05DD4BE081 (notifications_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publications ADD CONSTRAINT FK_32783AF438B217A7 FOREIGN KEY (publication_id) REFERENCES liked (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DAFFB3979 FOREIGN KEY (publications_id) REFERENCES publications (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D15BF9993 FOREIGN KEY (followers_id) REFERENCES follow (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D1816E3A3 FOREIGN KEY (following_id) REFERENCES follow (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D2F23775F FOREIGN KEY (likes_id) REFERENCES liked (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D37BC4DC6 FOREIGN KEY (emitter_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DB821E5F5 FOREIGN KEY (received_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DD4BE081 FOREIGN KEY (notifications_id) REFERENCES notification (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publications DROP FOREIGN KEY FK_32783AF438B217A7');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DAFFB3979');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D15BF9993');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D1816E3A3');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D2F23775F');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D37BC4DC6');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DB821E5F5');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DD4BE081');
        $this->addSql('DROP TABLE follow');
        $this->addSql('DROP TABLE liked');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE publications');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
