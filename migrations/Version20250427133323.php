<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250427133323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planet ADD image_code VARCHAR(32) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planet ADD image_blur VARCHAR(48) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planet ADD image_path VARCHAR(48) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planet DROP image_code
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planet DROP image_blur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planet DROP image_path
        SQL);
    }
}
