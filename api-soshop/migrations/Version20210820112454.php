<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820112454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card_bank ADD deletion_date DATE DEFAULT NULL, ADD expiry_date DATE NOT NULL');
        $this->addSql('ALTER TABLE user ADD birthday DATE NOT NULL, ADD deletion_date DATE DEFAULT NULL, CHANGE phone phone VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card_bank DROP deletion_date, DROP expiry_date');
        $this->addSql('ALTER TABLE user DROP birthday, DROP deletion_date, CHANGE phone phone VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
