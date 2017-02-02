<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170131183625 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE package_translation DROP FOREIGN KEY FK_79B25F09F44CABFF');
        $this->addSql('CREATE TABLE coaching_package (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, position INT DEFAULT NULL, remote TINYINT(1) NOT NULL, on_site TINYINT(1) NOT NULL, duration TIME NOT NULL, emergency_calls INT NOT NULL, emails INT NOT NULL, minimal_engagement INT NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_75861FF5ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coaching_package_translation (id INT AUTO_INCREMENT NOT NULL, package_id INT NOT NULL, locale VARCHAR(5) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_5ADBA144F44CABFF (package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coaching_package ADD CONSTRAINT FK_75861FF5ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE coaching_package_translation ADD CONSTRAINT FK_5ADBA144F44CABFF FOREIGN KEY (package_id) REFERENCES coaching_package (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO coaching_package SELECT * FROM package');
        $this->addSql('INSERT INTO coaching_package_translation SELECT * FROM package_translation');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE package_translation');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coaching_package_translation DROP FOREIGN KEY FK_5ADBA144F44CABFF');
        $this->addSql('CREATE TABLE package (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, position INT DEFAULT NULL, remote TINYINT(1) NOT NULL, on_site TINYINT(1) NOT NULL, duration TIME NOT NULL, emergency_calls INT NOT NULL, emails INT NOT NULL, minimal_engagement INT NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_DE686795ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package_translation (id INT AUTO_INCREMENT NOT NULL, package_id INT NOT NULL, locale VARCHAR(5) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_79B25F09F44CABFF (package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE686795ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE package_translation ADD CONSTRAINT FK_79B25F09F44CABFF FOREIGN KEY (package_id) REFERENCES package (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO package SELECT * FROM coaching_package');
        $this->addSql('INSERT INTO package_translation SELECT * FROM coaching_package_translation');
        $this->addSql('DROP TABLE coaching_package');
        $this->addSql('DROP TABLE coaching_package_translation');
    }
}
