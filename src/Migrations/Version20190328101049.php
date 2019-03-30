<?php

declare(strict_types=1);

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328101049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photoshoot_image (id INT AUTO_INCREMENT NOT NULL, photoshoot_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_8DA99ED02191CB92 (photoshoot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photoshoot (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, photographer VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, is_posted TINYINT(1) NOT NULL, publication_date DATE DEFAULT NULL, INDEX IDX_AC503E5112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photoshoot_image ADD CONSTRAINT FK_8DA99ED02191CB92 FOREIGN KEY (photoshoot_id) REFERENCES photoshoot (id)');
        $this->addSql('ALTER TABLE photoshoot ADD CONSTRAINT FK_AC503E5112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photoshoot DROP FOREIGN KEY FK_AC503E5112469DE2');
        $this->addSql('ALTER TABLE photoshoot_image DROP FOREIGN KEY FK_8DA99ED02191CB92');
        $this->addSql('DROP TABLE photoshoot_image');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE photoshoot');
    }
}
