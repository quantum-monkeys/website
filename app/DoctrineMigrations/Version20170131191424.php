<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170131191424 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE development_package (id INT AUTO_INCREMENT NOT NULL, position INT DEFAULT NULL, senior_developers_count INT DEFAULT NULL, medium_developers_count INT DEFAULT NULL, junior_developers_count INT DEFAULT NULL, minimal_engagement INT NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE development_package_translation (id INT AUTO_INCREMENT NOT NULL, package_id INT NOT NULL, locale VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_6AB2A8E0F44CABFF (package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE development_package_translation ADD CONSTRAINT FK_6AB2A8E0F44CABFF FOREIGN KEY (package_id) REFERENCES development_package (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE development_package_translation DROP FOREIGN KEY FK_6AB2A8E0F44CABFF');
        $this->addSql('DROP TABLE development_package');
        $this->addSql('DROP TABLE development_package_translation');
    }
}
