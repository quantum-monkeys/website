<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170309141836 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE landing_page (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE landing_page_translation (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, landing_page_id INT NOT NULL, locale VARCHAR(5) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, intro LONGTEXT NOT NULL, submit_button_label VARCHAR(255) NOT NULL, form_title VARCHAR(255) NOT NULL, INDEX IDX_4978FE07EE45BDBF (picture_id), INDEX IDX_4978FE07DF122DC5 (landing_page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE landing_page_translation ADD CONSTRAINT FK_4978FE07EE45BDBF FOREIGN KEY (picture_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE landing_page_translation ADD CONSTRAINT FK_4978FE07DF122DC5 FOREIGN KEY (landing_page_id) REFERENCES landing_page (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE landing_page_translation DROP FOREIGN KEY FK_4978FE07DF122DC5');
        $this->addSql('DROP TABLE landing_page');
        $this->addSql('DROP TABLE landing_page_translation');
    }
}
