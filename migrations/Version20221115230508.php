<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115230508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playlist DROP description_fr, DROP description_it, DROP title_fr, DROP title_it');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playlist ADD description_fr LONGTEXT DEFAULT NULL, ADD description_it LONGTEXT DEFAULT NULL, ADD title_fr VARCHAR(255) DEFAULT NULL, ADD title_it VARCHAR(255) DEFAULT NULL');
    }
}
