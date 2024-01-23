<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123153520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ruta (id INT AUTO_INCREMENT NOT NULL, cod_localidad_id_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, participantes INT NOT NULL, foto VARCHAR(255) NOT NULL, punto_inicio VARCHAR(255) NOT NULL, INDEX IDX_C3AEF08CC9C1C724 (cod_localidad_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ruta ADD CONSTRAINT FK_C3AEF08CC9C1C724 FOREIGN KEY (cod_localidad_id_id) REFERENCES localidad (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ruta DROP FOREIGN KEY FK_C3AEF08CC9C1C724');
        $this->addSql('DROP TABLE ruta');
    }
}
