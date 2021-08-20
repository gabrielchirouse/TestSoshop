<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820105942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_bank ADD card_bank_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE account_bank ADD CONSTRAINT FK_54F338D046D27137 FOREIGN KEY (card_bank_id) REFERENCES card_bank (id)');
        $this->addSql('ALTER TABLE account_bank ADD CONSTRAINT FK_54F338D0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54F338D046D27137 ON account_bank (card_bank_id)');
        $this->addSql('CREATE INDEX IDX_54F338D0A76ED395 ON account_bank (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_bank DROP FOREIGN KEY FK_54F338D046D27137');
        $this->addSql('ALTER TABLE account_bank DROP FOREIGN KEY FK_54F338D0A76ED395');
        $this->addSql('DROP INDEX UNIQ_54F338D046D27137 ON account_bank');
        $this->addSql('DROP INDEX IDX_54F338D0A76ED395 ON account_bank');
        $this->addSql('ALTER TABLE account_bank DROP card_bank_id, DROP user_id');
    }
}
