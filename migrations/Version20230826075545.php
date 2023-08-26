<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230826075545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '0002. Add files table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE files_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE files (id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE products ADD bg_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA568F5BF FOREIGN KEY (bg_image_id) REFERENCES files (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5AA568F5BF ON products (bg_image_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5AA568F5BF');
        $this->addSql('DROP SEQUENCE files_id_seq CASCADE');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP INDEX UNIQ_B3BA5A5AA568F5BF');
        $this->addSql('ALTER TABLE products DROP bg_image_id');
    }
}
