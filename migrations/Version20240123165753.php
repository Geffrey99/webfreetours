<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123165753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE informe (id INT AUTO_INCREMENT NOT NULL, cod_tour_id INT DEFAULT NULL, imagen VARCHAR(255) NOT NULL, observaciones VARCHAR(255) NOT NULL, recaudacion INT NOT NULL, UNIQUE INDEX UNIQ_7E75E1D987557DD7 (cod_tour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localidad (id INT AUTO_INCREMENT NOT NULL, cod_provincia_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_4F68E01064ABF1E8 (cod_provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provincia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ruta (id INT AUTO_INCREMENT NOT NULL, ruta_visita_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, punto_inicio VARCHAR(255) NOT NULL, participantes VARCHAR(255) NOT NULL, INDEX IDX_C3AEF08C2BC6B0AE (ruta_visita_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ruta_visita (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, cod_ruta_id INT DEFAULT NULL, fecha_hora DATETIME NOT NULL, INDEX IDX_6AD1F9693904B8D1 (cod_ruta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tour (id INT AUTO_INCREMENT NOT NULL, cod_user_id INT DEFAULT NULL, cod_tour_id INT DEFAULT NULL, fecha_reserva VARCHAR(255) NOT NULL, asistentes INT NOT NULL, num_gente_reserva INT NOT NULL, INDEX IDX_1050B5A035D62301 (cod_user_id), INDEX IDX_1050B5A087557DD7 (cod_tour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valoracion (id INT AUTO_INCREMENT NOT NULL, cod_reserva_id INT DEFAULT NULL, nota_guia INT NOT NULL, nota_ruta INT NOT NULL, comentario VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6D3DE0F4FD6DF355 (cod_reserva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visita (id INT AUTO_INCREMENT NOT NULL, cod_localidad_id INT DEFAULT NULL, ruta_visita_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, gps VARCHAR(255) NOT NULL, INDEX IDX_B7F148A24DAAACCE (cod_localidad_id), INDEX IDX_B7F148A22BC6B0AE (ruta_visita_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE informe ADD CONSTRAINT FK_7E75E1D987557DD7 FOREIGN KEY (cod_tour_id) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E01064ABF1E8 FOREIGN KEY (cod_provincia_id) REFERENCES provincia (id)');
        $this->addSql('ALTER TABLE ruta ADD CONSTRAINT FK_C3AEF08C2BC6B0AE FOREIGN KEY (ruta_visita_id) REFERENCES ruta_visita (id)');
        $this->addSql('ALTER TABLE tour ADD CONSTRAINT FK_6AD1F9693904B8D1 FOREIGN KEY (cod_ruta_id) REFERENCES ruta (id)');
        $this->addSql('ALTER TABLE user_tour ADD CONSTRAINT FK_1050B5A035D62301 FOREIGN KEY (cod_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_tour ADD CONSTRAINT FK_1050B5A087557DD7 FOREIGN KEY (cod_tour_id) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE valoracion ADD CONSTRAINT FK_6D3DE0F4FD6DF355 FOREIGN KEY (cod_reserva_id) REFERENCES user_tour (id)');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A24DAAACCE FOREIGN KEY (cod_localidad_id) REFERENCES localidad (id)');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A22BC6B0AE FOREIGN KEY (ruta_visita_id) REFERENCES ruta_visita (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE informe DROP FOREIGN KEY FK_7E75E1D987557DD7');
        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E01064ABF1E8');
        $this->addSql('ALTER TABLE ruta DROP FOREIGN KEY FK_C3AEF08C2BC6B0AE');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F9693904B8D1');
        $this->addSql('ALTER TABLE user_tour DROP FOREIGN KEY FK_1050B5A035D62301');
        $this->addSql('ALTER TABLE user_tour DROP FOREIGN KEY FK_1050B5A087557DD7');
        $this->addSql('ALTER TABLE valoracion DROP FOREIGN KEY FK_6D3DE0F4FD6DF355');
        $this->addSql('ALTER TABLE visita DROP FOREIGN KEY FK_B7F148A24DAAACCE');
        $this->addSql('ALTER TABLE visita DROP FOREIGN KEY FK_B7F148A22BC6B0AE');
        $this->addSql('DROP TABLE informe');
        $this->addSql('DROP TABLE localidad');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('DROP TABLE ruta');
        $this->addSql('DROP TABLE ruta_visita');
        $this->addSql('DROP TABLE tour');
        $this->addSql('DROP TABLE user_tour');
        $this->addSql('DROP TABLE valoracion');
        $this->addSql('DROP TABLE visita');
    }
}
