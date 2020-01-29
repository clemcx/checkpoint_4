<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129115542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3313E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE5A3313E2E969B ON book (review_id)');
        $this->addSql('ALTER TABLE movie ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F3E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F3E2E969B ON movie (review_id)');
        $this->addSql('ALTER TABLE serie ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A93343E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA3A93343E2E969B ON serie (review_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3313E2E969B');
        $this->addSql('DROP INDEX UNIQ_CBE5A3313E2E969B ON book');
        $this->addSql('ALTER TABLE book DROP review_id');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F3E2E969B');
        $this->addSql('DROP INDEX UNIQ_1D5EF26F3E2E969B ON movie');
        $this->addSql('ALTER TABLE movie DROP review_id');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A93343E2E969B');
        $this->addSql('DROP INDEX UNIQ_AA3A93343E2E969B ON serie');
        $this->addSql('ALTER TABLE serie DROP review_id');
    }
}
