<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190320004353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photoshoot_image (id INT AUTO_INCREMENT NOT NULL, photoshoot_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_8DA99ED02191CB92 (photoshoot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photoshoot (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, photographer VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, is_posted TINYINT(1) NOT NULL, publication_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photoshoot_image ADD CONSTRAINT FK_8DA99ED02191CB92 FOREIGN KEY (photoshoot_id) REFERENCES photoshoot (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photoshoot_image DROP FOREIGN KEY FK_8DA99ED02191CB92');
        $this->addSql('DROP TABLE photoshoot_image');
        $this->addSql('DROP TABLE photoshoot');
    }
}
