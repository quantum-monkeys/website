<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161116223348 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, begin DATETIME NOT NULL, end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_module (course_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_A21CE765591CC992 (course_id), INDEX IDX_A21CE765AFC2B591 (module_id), PRIMARY KEY(course_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_trainer (workshop_session_id INT NOT NULL, speaker_id INT NOT NULL, INDEX IDX_CDD60DCCE6C175BA (workshop_session_id), INDEX IDX_CDD60DCCD04A0F27 (speaker_id), PRIMARY KEY(workshop_session_id, speaker_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, workshop_id INT DEFAULT NULL, learning_path_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D044D5D41FDCE57C (workshop_id), INDEX IDX_D044D5D41DCBEE98 (learning_path_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop_session_trainer (workshop_session_id INT NOT NULL, speaker_id INT NOT NULL, INDEX IDX_8DCF8C3FE6C175BA (workshop_session_id), UNIQUE INDEX UNIQ_8DCF8C3FD04A0F27 (speaker_id), PRIMARY KEY(workshop_session_id, speaker_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE learning_path_session_course (learning_path_session_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_FD1A36DA874F6B98 (learning_path_session_id), UNIQUE INDEX UNIQ_FD1A36DA591CC992 (course_id), PRIMARY KEY(learning_path_session_id, course_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_session_module (session_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_49AA19AB613FECDF (session_id), INDEX IDX_49AA19ABAFC2B591 (module_id), PRIMARY KEY(session_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_session_course (custom_session_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_5310503A5EC0D075 (custom_session_id), INDEX IDX_5310503A591CC992 (course_id), PRIMARY KEY(custom_session_id, course_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_module ADD CONSTRAINT FK_A21CE765591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_module ADD CONSTRAINT FK_A21CE765AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE course_trainer ADD CONSTRAINT FK_CDD60DCCE6C175BA FOREIGN KEY (workshop_session_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_trainer ADD CONSTRAINT FK_CDD60DCCD04A0F27 FOREIGN KEY (speaker_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D41FDCE57C FOREIGN KEY (workshop_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D41DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop_session_trainer ADD CONSTRAINT FK_8DCF8C3FE6C175BA FOREIGN KEY (workshop_session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE workshop_session_trainer ADD CONSTRAINT FK_8DCF8C3FD04A0F27 FOREIGN KEY (speaker_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE learning_path_session_course ADD CONSTRAINT FK_FD1A36DA874F6B98 FOREIGN KEY (learning_path_session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE learning_path_session_course ADD CONSTRAINT FK_FD1A36DA591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE custom_session_module ADD CONSTRAINT FK_49AA19AB613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE custom_session_module ADD CONSTRAINT FK_49AA19ABAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE custom_session_course ADD CONSTRAINT FK_5310503A5EC0D075 FOREIGN KEY (custom_session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE custom_session_course ADD CONSTRAINT FK_5310503A591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_module DROP FOREIGN KEY FK_A21CE765591CC992');
        $this->addSql('ALTER TABLE course_trainer DROP FOREIGN KEY FK_CDD60DCCE6C175BA');
        $this->addSql('ALTER TABLE learning_path_session_course DROP FOREIGN KEY FK_FD1A36DA591CC992');
        $this->addSql('ALTER TABLE custom_session_course DROP FOREIGN KEY FK_5310503A591CC992');
        $this->addSql('ALTER TABLE workshop_session_trainer DROP FOREIGN KEY FK_8DCF8C3FE6C175BA');
        $this->addSql('ALTER TABLE learning_path_session_course DROP FOREIGN KEY FK_FD1A36DA874F6B98');
        $this->addSql('ALTER TABLE custom_session_module DROP FOREIGN KEY FK_49AA19AB613FECDF');
        $this->addSql('ALTER TABLE custom_session_course DROP FOREIGN KEY FK_5310503A5EC0D075');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_module');
        $this->addSql('DROP TABLE course_trainer');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE workshop_session_trainer');
        $this->addSql('DROP TABLE learning_path_session_course');
        $this->addSql('DROP TABLE custom_session_module');
        $this->addSql('DROP TABLE custom_session_course');
    }
}
