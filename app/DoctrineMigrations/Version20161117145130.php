<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161117145130 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE session_course (session_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_79F565E0613FECDF (session_id), INDEX IDX_79F565E0591CC992 (course_id), PRIMARY KEY(session_id, course_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session_course ADD CONSTRAINT FK_79F565E0613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session_course ADD CONSTRAINT FK_79F565E0591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('DROP TABLE custom_session_course');
        $this->addSql('DROP TABLE learning_path_session_course');
        $this->addSql('DROP TABLE workshop_session_trainer');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE custom_session_course (custom_session_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_5310503A5EC0D075 (custom_session_id), INDEX IDX_5310503A591CC992 (course_id), PRIMARY KEY(custom_session_id, course_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE learning_path_session_course (learning_path_session_id INT NOT NULL, course_id INT NOT NULL, UNIQUE INDEX UNIQ_FD1A36DA591CC992 (course_id), INDEX IDX_FD1A36DA874F6B98 (learning_path_session_id), PRIMARY KEY(learning_path_session_id, course_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop_session_trainer (workshop_session_id INT NOT NULL, speaker_id INT NOT NULL, UNIQUE INDEX UNIQ_8DCF8C3FD04A0F27 (speaker_id), INDEX IDX_8DCF8C3FE6C175BA (workshop_session_id), PRIMARY KEY(workshop_session_id, speaker_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE custom_session_course ADD CONSTRAINT FK_5310503A591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE custom_session_course ADD CONSTRAINT FK_5310503A5EC0D075 FOREIGN KEY (custom_session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE learning_path_session_course ADD CONSTRAINT FK_FD1A36DA591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE learning_path_session_course ADD CONSTRAINT FK_FD1A36DA874F6B98 FOREIGN KEY (learning_path_session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE workshop_session_trainer ADD CONSTRAINT FK_8DCF8C3FD04A0F27 FOREIGN KEY (speaker_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE workshop_session_trainer ADD CONSTRAINT FK_8DCF8C3FE6C175BA FOREIGN KEY (workshop_session_id) REFERENCES session (id)');
        $this->addSql('DROP TABLE session_course');
    }
}
