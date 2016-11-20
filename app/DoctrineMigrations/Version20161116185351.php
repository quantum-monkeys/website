<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161116185351 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, learning_path_id INT NOT NULL, INDEX IDX_C2426281DCBEE98 (learning_path_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_translation (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, locale VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_3A424FBDAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, position INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D5128A8FEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_translation (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, locale VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, abstract LONGTEXT DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_10023FB8BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426281DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_translation ADD CONSTRAINT FK_3A424FBDAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FEE45BDBF FOREIGN KEY (picture_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE training_translation ADD CONSTRAINT FK_10023FB8BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module_translation DROP FOREIGN KEY FK_3A424FBDAFC2B591');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426281DCBEE98');
        $this->addSql('ALTER TABLE training_translation DROP FOREIGN KEY FK_10023FB8BEFD98D1');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_translation');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE training_translation');
    }
}
