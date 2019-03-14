<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314012115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photoshoot_image DROP FOREIGN KEY FK_B6068D226EF8C321');
        $this->addSql('DROP INDEX IDX_B6068D226EF8C321 ON photoshoot_image');
        $this->addSql('ALTER TABLE photoshoot_image CHANGE photoshot_id photoshoot_id INT NOT NULL');
        $this->addSql('ALTER TABLE photoshoot_image ADD CONSTRAINT FK_8DA99ED02191CB92 FOREIGN KEY (photoshoot_id) REFERENCES photoshoot (id)');
        $this->addSql('CREATE INDEX IDX_8DA99ED02191CB92 ON photoshoot_image (photoshoot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photoshoot_image DROP FOREIGN KEY FK_8DA99ED02191CB92');
        $this->addSql('DROP INDEX IDX_8DA99ED02191CB92 ON photoshoot_image');
        $this->addSql('ALTER TABLE photoshoot_image CHANGE photoshoot_id photoshot_id INT NOT NULL');
        $this->addSql('ALTER TABLE photoshoot_image ADD CONSTRAINT FK_B6068D226EF8C321 FOREIGN KEY (photoshot_id) REFERENCES photoshoot (id)');
        $this->addSql('CREATE INDEX IDX_B6068D226EF8C321 ON photoshoot_image (photoshot_id)');
    }
}
