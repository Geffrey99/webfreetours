<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123152134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE localidad (id INT AUTO_INCREMENT NOT NULL, cod_provincia_id_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_4F68E0108D13EED0 (cod_provincia_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E0108D13EED0 FOREIGN KEY (cod_provincia_id_id) REFERENCES provincia (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E0108D13EED0');
        $this->addSql('DROP TABLE localidad');
    }
}
