<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170320105259 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_translation (id INT AUTO_INCREMENT NOT NULL, main_picture_id INT DEFAULT NULL, campaign_id INT NOT NULL, document_id INT DEFAULT NULL, locale VARCHAR(5) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, main_content LONGTEXT NOT NULL, main_form_title VARCHAR(255) NOT NULL, main_submit_button_label VARCHAR(255) NOT NULL, main_success_message VARCHAR(255) NOT NULL, contact_content LONGTEXT NOT NULL, contact_form_title VARCHAR(255) NOT NULL, contact_submit_button_label VARCHAR(255) NOT NULL, contact_success_message VARCHAR(255) NOT NULL, first_email_subject VARCHAR(255) NOT NULL, first_email_content LONGTEXT NOT NULL, mail_chimp_list_id VARCHAR(255) NOT NULL, INDEX IDX_6CA37995D6BDC9DC (main_picture_id), INDEX IDX_6CA37995F639F774 (campaign_id), INDEX IDX_6CA37995C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, size VARCHAR(255) DEFAULT NULL, methodology VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, campaign_translation_id INT DEFAULT NULL, company_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, job_title VARCHAR(255) DEFAULT NULL, contact_reason LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', message LONGTEXT DEFAULT NULL, INDEX IDX_4C62E6382CBB8FAA (campaign_translation_id), INDEX IDX_4C62E638979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaign_translation ADD CONSTRAINT FK_6CA37995D6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE campaign_translation ADD CONSTRAINT FK_6CA37995F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_translation ADD CONSTRAINT FK_6CA37995C33F7837 FOREIGN KEY (document_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6382CBB8FAA FOREIGN KEY (campaign_translation_id) REFERENCES campaign_translation (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign_translation DROP FOREIGN KEY FK_6CA37995F639F774');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6382CBB8FAA');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638979B1AD6');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE campaign_translation');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE contact');
    }
}
