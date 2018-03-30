<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180328153018 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE civilite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD civilite_id INT DEFAULT NULL, CHANGE telephone telephone VARCHAR(15) DEFAULT NULL, CHANGE email email VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045539194ABF FOREIGN KEY (civilite_id) REFERENCES civilite (id)');
        $this->addSql('CREATE INDEX IDX_C744045539194ABF ON client (civilite_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045539194ABF');
        $this->addSql('DROP TABLE civilite');
        $this->addSql('DROP INDEX IDX_C744045539194ABF ON client');
        $this->addSql('ALTER TABLE client DROP civilite_id, CHANGE telephone telephone VARCHAR(15) NOT NULL COLLATE utf8_unicode_ci, CHANGE email email VARCHAR(200) NOT NULL COLLATE utf8_unicode_ci');
    }
}
