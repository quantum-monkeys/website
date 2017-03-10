<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170310153746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE landing_page_contact (id INT AUTO_INCREMENT NOT NULL, landing_page_translation_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_F0C834A7B7EFE6C1 (landing_page_translation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE landing_page_contact ADD CONSTRAINT FK_F0C834A7B7EFE6C1 FOREIGN KEY (landing_page_translation_id) REFERENCES landing_page_translation (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE landing_page_translation ADD success_message VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE landing_page_contact');
        $this->addSql('ALTER TABLE landing_page_translation DROP success_message');
    }
}
