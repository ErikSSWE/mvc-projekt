<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524140034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE highscore (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, score INTEGER NOT NULL, date DATE NOT NULL)');
        $this->addSql('CREATE TABLE result (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, player VARCHAR(255) NOT NULL, score INTEGER NOT NULL, date DATE NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE highscore');
        $this->addSql('DROP TABLE result');
    }
}
