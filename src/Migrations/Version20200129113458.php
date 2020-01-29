<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129113458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, publication_year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, birth_year INT NOT NULL, death_year INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, release_year INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_actor (movie_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_3A374C658F93B6FC (movie_id), INDEX IDX_3A374C6510DAF24A (actor_id), PRIMARY KEY(movie_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, release_date INT NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_actor (serie_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_8C79626DD94388BD (serie_id), INDEX IDX_8C79626D10DAF24A (actor_id), PRIMARY KEY(serie_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C658F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C6510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_actor ADD CONSTRAINT FK_8C79626DD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_actor ADD CONSTRAINT FK_8C79626D10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C6510DAF24A');
        $this->addSql('ALTER TABLE serie_actor DROP FOREIGN KEY FK_8C79626D10DAF24A');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C658F93B6FC');
        $this->addSql('ALTER TABLE serie_actor DROP FOREIGN KEY FK_8C79626DD94388BD');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_actor');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE serie_actor');
    }
}
