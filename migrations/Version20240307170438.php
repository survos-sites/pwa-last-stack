<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307170438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__planet AS SELECT id, name, description, light_years_from_earth, image_filename, is_in_milky_way FROM planet');
        $this->addSql('DROP TABLE planet');
        $this->addSql('CREATE TABLE planet (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, light_years_from_earth DOUBLE PRECISION NOT NULL, image_filename VARCHAR(255) NOT NULL, is_in_milky_way BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO planet (id, name, description, light_years_from_earth, image_filename, is_in_milky_way) SELECT id, name, description, light_years_from_earth, image_filename, is_in_milky_way FROM __temp__planet');
        $this->addSql('DROP TABLE __temp__planet');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__planet AS SELECT id, name, description, light_years_from_earth, image_filename, is_in_milky_way FROM planet');
        $this->addSql('DROP TABLE planet');
        $this->addSql('CREATE TABLE planet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, light_years_from_earth DOUBLE PRECISION NOT NULL, image_filename VARCHAR(255) NOT NULL, is_in_milky_way BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO planet (id, name, description, light_years_from_earth, image_filename, is_in_milky_way) SELECT id, name, description, light_years_from_earth, image_filename, is_in_milky_way FROM __temp__planet');
        $this->addSql('DROP TABLE __temp__planet');
    }
}
