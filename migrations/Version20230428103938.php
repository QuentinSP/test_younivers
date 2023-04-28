<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428103938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content_sector (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO content_sector (nom) VALUES ("Diaporama")');
        $this->addSql('INSERT INTO content_sector (nom) VALUES ("Nos Marques")');
        $this->addSql('ALTER TABLE content ADD content_sector_id INT NOT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9EE728064 FOREIGN KEY (content_sector_id) REFERENCES content_sector (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9EE728064 ON content (content_sector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9EE728064');
        $this->addSql('DROP TABLE content_sector');
        $this->addSql('DROP INDEX IDX_FEC530A9EE728064 ON content');
        $this->addSql('ALTER TABLE content DROP content_sector_id');
    }
}
