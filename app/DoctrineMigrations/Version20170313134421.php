<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170313134421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE landing_page_translation ADD document_id INT DEFAULT NULL, ADD email_subject VARCHAR(255) NOT NULL, ADD email_content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE landing_page_translation ADD CONSTRAINT FK_4978FE07C33F7837 FOREIGN KEY (document_id) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_4978FE07C33F7837 ON landing_page_translation (document_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE landing_page_translation DROP FOREIGN KEY FK_4978FE07C33F7837');
        $this->addSql('DROP INDEX IDX_4978FE07C33F7837 ON landing_page_translation');
        $this->addSql('ALTER TABLE landing_page_translation DROP document_id, DROP email_subject, DROP email_content');
    }
}
