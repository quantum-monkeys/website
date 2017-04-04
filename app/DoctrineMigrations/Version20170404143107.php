<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170404143107 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DDF675F31B FOREIGN KEY (author_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_1F1512DDF675F31B ON campaign (author_id)');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1762D117DC1');
        $this->addSql('DROP INDEX IDX_34DCD1762D117DC1 ON person');
        $this->addSql('ALTER TABLE person DROP picture_square_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DDF675F31B');
        $this->addSql('DROP INDEX IDX_1F1512DDF675F31B ON campaign');
        $this->addSql('ALTER TABLE campaign DROP author_id');
        $this->addSql('ALTER TABLE person ADD picture_square_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1762D117DC1 FOREIGN KEY (picture_square_id) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_34DCD1762D117DC1 ON person (picture_square_id)');
    }
}
