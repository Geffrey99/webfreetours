<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124100424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ruta_visita (id INT AUTO_INCREMENT NOT NULL, cod_ruta_id INT DEFAULT NULL, cod_visita_id INT DEFAULT NULL, INDEX IDX_BF0956A13904B8D1 (cod_ruta_id), INDEX IDX_BF0956A1E63764B4 (cod_visita_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ruta_visita ADD CONSTRAINT FK_BF0956A13904B8D1 FOREIGN KEY (cod_ruta_id) REFERENCES ruta (id)');
        $this->addSql('ALTER TABLE ruta_visita ADD CONSTRAINT FK_BF0956A1E63764B4 FOREIGN KEY (cod_visita_id) REFERENCES visita (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ruta_visita DROP FOREIGN KEY FK_BF0956A13904B8D1');
        $this->addSql('ALTER TABLE ruta_visita DROP FOREIGN KEY FK_BF0956A1E63764B4');
        $this->addSql('DROP TABLE ruta_visita');
    }
}
