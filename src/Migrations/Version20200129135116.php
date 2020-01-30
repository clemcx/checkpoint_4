<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129135116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE art_genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE art_genre_work (art_genre_id INT NOT NULL, work_id INT NOT NULL, INDEX IDX_DDE294381B91AA09 (art_genre_id), INDEX IDX_DDE29438BB3453DB (work_id), PRIMARY KEY(art_genre_id, work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, work_id INT DEFAULT NULL, author VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, published_date DATETIME NOT NULL, edit_date DATETIME DEFAULT NULL, INDEX IDX_794381C6BB3453DB (work_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT NULL, birth_date DATETIME DEFAULT NULL, death_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor_work (actor_id INT NOT NULL, work_id INT NOT NULL, INDEX IDX_63065A7310DAF24A (actor_id), INDEX IDX_63065A73BB3453DB (work_id), PRIMARY KEY(actor_id, work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE art_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, art_type_id INT DEFAULT NULL, description LONGTEXT NOT NULL, creator VARCHAR(255) NOT NULL, release_date INT NOT NULL, INDEX IDX_534E688071088DEF (art_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE art_genre_work ADD CONSTRAINT FK_DDE294381B91AA09 FOREIGN KEY (art_genre_id) REFERENCES art_genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE art_genre_work ADD CONSTRAINT FK_DDE29438BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6BB3453DB FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('ALTER TABLE actor_work ADD CONSTRAINT FK_63065A7310DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_work ADD CONSTRAINT FK_63065A73BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E688071088DEF FOREIGN KEY (art_type_id) REFERENCES art_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE art_genre_work DROP FOREIGN KEY FK_DDE294381B91AA09');
        $this->addSql('ALTER TABLE actor_work DROP FOREIGN KEY FK_63065A7310DAF24A');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E688071088DEF');
        $this->addSql('ALTER TABLE art_genre_work DROP FOREIGN KEY FK_DDE29438BB3453DB');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6BB3453DB');
        $this->addSql('ALTER TABLE actor_work DROP FOREIGN KEY FK_63065A73BB3453DB');
        $this->addSql('DROP TABLE art_genre');
        $this->addSql('DROP TABLE art_genre_work');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE actor_work');
        $this->addSql('DROP TABLE art_type');
        $this->addSql('DROP TABLE work');
    }
}
