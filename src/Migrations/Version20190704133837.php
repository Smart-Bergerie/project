<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190704133837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP create_at, CHANGE sexe sexe INT NOT NULL, CHANGE ip_adresse ip_adresse VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE profil_file_name profil_file_name VARCHAR(255) DEFAULT NULL, CHANGE token_reset_password token_reset_password VARCHAR(255) DEFAULT NULL, CHANGE create_token_password_at create_token_password_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD create_at DATETIME NOT NULL, CHANGE sexe sexe VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE ip_adresse ip_adresse VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at DATETIME NOT NULL, CHANGE profil_file_name profil_file_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE token_reset_password token_reset_password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE create_token_password_at create_token_password_at DATETIME NOT NULL');
    }
}
