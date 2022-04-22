<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422135746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, sender_email VARCHAR(255) NOT NULL, sender_name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, is_active TINYINT(1) NOT NULL, is_done TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, main_title VARCHAR(255) NOT NULL, first_title VARCHAR(255) DEFAULT NULL, second_title VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, priority INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_project_member (project_id INT NOT NULL, project_member_id INT NOT NULL, INDEX IDX_8EF72590166D1F9C (project_id), INDEX IDX_8EF7259064AB9629 (project_member_id), PRIMARY KEY(project_id, project_member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_member (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, artist_name VARCHAR(255) DEFAULT NULL, features VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT NOT NULL, venue VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, name VARCHAR(255) DEFAULT NULL, is_passed TINYINT(1) NOT NULL, is_cancelled TINYINT(1) NOT NULL, venue_url VARCHAR(255) DEFAULT NULL, location_url VARCHAR(255) DEFAULT NULL, ticket_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, src VARCHAR(255) NOT NULL, priority INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zamua_files (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, is_gallery_item TINYINT(1) NOT NULL, priority INT DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, credit VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zamua_files_project (zamua_files_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_186EFFD45604E53A (zamua_files_id), INDEX IDX_186EFFD4166D1F9C (project_id), PRIMARY KEY(zamua_files_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_project_member ADD CONSTRAINT FK_8EF72590166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_project_member ADD CONSTRAINT FK_8EF7259064AB9629 FOREIGN KEY (project_member_id) REFERENCES project_member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zamua_files_project ADD CONSTRAINT FK_186EFFD45604E53A FOREIGN KEY (zamua_files_id) REFERENCES zamua_files (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zamua_files_project ADD CONSTRAINT FK_186EFFD4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_project_member DROP FOREIGN KEY FK_8EF72590166D1F9C');
        $this->addSql('ALTER TABLE zamua_files_project DROP FOREIGN KEY FK_186EFFD4166D1F9C');
        $this->addSql('ALTER TABLE project_project_member DROP FOREIGN KEY FK_8EF7259064AB9629');
        $this->addSql('ALTER TABLE zamua_files_project DROP FOREIGN KEY FK_186EFFD45604E53A');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_project_member');
        $this->addSql('DROP TABLE project_member');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE zamua_files');
        $this->addSql('DROP TABLE zamua_files_project');
    }
}
