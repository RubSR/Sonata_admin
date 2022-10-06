<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006185544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direccion ADD municipio_id INT NOT NULL, ADD provincia_id INT NOT NULL');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE9558BC1BE0 FOREIGN KEY (municipio_id) REFERENCES municipios (id)');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE954E7121AF FOREIGN KEY (provincia_id) REFERENCES provincias (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F384BE9558BC1BE0 ON direccion (municipio_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F384BE954E7121AF ON direccion (provincia_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE9558BC1BE0');
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE954E7121AF');
        $this->addSql('DROP INDEX UNIQ_F384BE9558BC1BE0 ON direccion');
        $this->addSql('DROP INDEX UNIQ_F384BE954E7121AF ON direccion');
        $this->addSql('ALTER TABLE direccion DROP municipio_id, DROP provincia_id');
    }
}
