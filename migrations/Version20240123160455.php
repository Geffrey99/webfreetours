<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123160455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visita (id INT AUTO_INCREMENT NOT NULL, cod_localidad_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, gps VARCHAR(255) NOT NULL, INDEX IDX_B7F148A24DAAACCE (cod_localidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A24DAAACCE FOREIGN KEY (cod_localidad_id) REFERENCES localidad (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visita DROP FOREIGN KEY FK_B7F148A24DAAACCE');
        $this->addSql('DROP TABLE visita');
    }
}
