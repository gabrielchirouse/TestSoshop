<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210821102550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_bank ADD deletion_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE card_bank DROP status');
        $this->addSql('ALTER TABLE card_bank ADD status  ENUM(\'active\', \'fermée\', \'volée\') DEFAULT \'active\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_bank DROP deletion_date');
        $this->addSql('ALTER TABLE card_bank DROP status');
        $this->addSql('ALTER TABLE card_bank ADD status VARCHAR(255) NOT NULL');

    }
}
