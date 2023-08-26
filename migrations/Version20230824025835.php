<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230824025835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '0001. Create products table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE products (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, price NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE products_id_seq CASCADE');
        $this->addSql('DROP TABLE products');
    }
}
