<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170120140233 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course_module DROP FOREIGN KEY FK_A21CE765591CC992');
        $this->addSql('ALTER TABLE course_trainer DROP FOREIGN KEY FK_CDD60DCCE6C175BA');
        $this->addSql('ALTER TABLE session_course DROP FOREIGN KEY FK_79F565E0591CC992');
        $this->addSql('ALTER TABLE discount_translation DROP FOREIGN KEY FK_F618B1574C7C611F');
        $this->addSql('ALTER TABLE course_module DROP FOREIGN KEY FK_A21CE765AFC2B591');
        $this->addSql('ALTER TABLE custom_session_module DROP FOREIGN KEY FK_49AA19ABAFC2B591');
        $this->addSql('ALTER TABLE module_translation DROP FOREIGN KEY FK_3A424FBDAFC2B591');
        $this->addSql('ALTER TABLE custom_session_module DROP FOREIGN KEY FK_49AA19AB613FECDF');
        $this->addSql('ALTER TABLE session_course DROP FOREIGN KEY FK_79F565E0613FECDF');
        $this->addSql('ALTER TABLE tag_translation DROP FOREIGN KEY FK_A8A03F8FBAD26311');
        $this->addSql('ALTER TABLE training_tag DROP FOREIGN KEY FK_9937C0CABAD26311');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426281DCBEE98');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D41DCBEE98');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D41FDCE57C');
        $this->addSql('ALTER TABLE training_tag DROP FOREIGN KEY FK_9937C0CABEFD98D1');
        $this->addSql('ALTER TABLE training_translation DROP FOREIGN KEY FK_10023FB8BEFD98D1');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_module');
        $this->addSql('DROP TABLE course_trainer');
        $this->addSql('DROP TABLE custom_session_module');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE discount_translation');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_translation');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_course');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_translation');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE training_tag');
        $this->addSql('DROP TABLE training_translation');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, begin DATETIME NOT NULL, end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_module (course_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_A21CE765591CC992 (course_id), INDEX IDX_A21CE765AFC2B591 (module_id), PRIMARY KEY(course_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_trainer (workshop_session_id INT NOT NULL, speaker_id INT NOT NULL, INDEX IDX_CDD60DCCE6C175BA (workshop_session_id), INDEX IDX_CDD60DCCD04A0F27 (speaker_id), PRIMARY KEY(workshop_session_id, speaker_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_session_module (session_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_49AA19AB613FECDF (session_id), INDEX IDX_49AA19ABAFC2B591 (module_id), PRIMARY KEY(session_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, position INT DEFAULT NULL, INDEX IDX_E1E0B40EEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount_translation (id INT AUTO_INCREMENT NOT NULL, discount_id INT NOT NULL, locale VARCHAR(5) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_F618B1574C7C611F (discount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, learning_path_id INT NOT NULL, INDEX IDX_C2426281DCBEE98 (learning_path_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_translation (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, locale VARCHAR(5) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_3A424FBDAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, learning_path_id INT DEFAULT NULL, workshop_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, language VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_D044D5D41FDCE57C (workshop_id), INDEX IDX_D044D5D41DCBEE98 (learning_path_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_course (session_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_79F565E0613FECDF (session_id), INDEX IDX_79F565E0591CC992 (course_id), PRIMARY KEY(session_id, course_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_translation (id INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, locale VARCHAR(5) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_A8A03F8FBAD26311 (tag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, position INT DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, cost NUMERIC(10, 2) NOT NULL, INDEX IDX_D5128A8FEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_tag (training_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_9937C0CABEFD98D1 (training_id), INDEX IDX_9937C0CABAD26311 (tag_id), PRIMARY KEY(training_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_translation (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, locale VARCHAR(5) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, abstract LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, certification VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_10023FB8BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_module ADD CONSTRAINT FK_A21CE765591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_module ADD CONSTRAINT FK_A21CE765AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE course_trainer ADD CONSTRAINT FK_CDD60DCCD04A0F27 FOREIGN KEY (speaker_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE course_trainer ADD CONSTRAINT FK_CDD60DCCE6C175BA FOREIGN KEY (workshop_session_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE custom_session_module ADD CONSTRAINT FK_49AA19AB613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE custom_session_module ADD CONSTRAINT FK_49AA19ABAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT FK_E1E0B40EEE45BDBF FOREIGN KEY (picture_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE discount_translation ADD CONSTRAINT FK_F618B1574C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426281DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_translation ADD CONSTRAINT FK_3A424FBDAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D41DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D41FDCE57C FOREIGN KEY (workshop_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_course ADD CONSTRAINT FK_79F565E0591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE session_course ADD CONSTRAINT FK_79F565E0613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE tag_translation ADD CONSTRAINT FK_A8A03F8FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FEE45BDBF FOREIGN KEY (picture_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE training_tag ADD CONSTRAINT FK_9937C0CABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE training_tag ADD CONSTRAINT FK_9937C0CABEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE training_translation ADD CONSTRAINT FK_10023FB8BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
    }
}
