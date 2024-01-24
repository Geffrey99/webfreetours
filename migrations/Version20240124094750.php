<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124094750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ruta_visita (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ruta ADD ruta_visita_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ruta ADD CONSTRAINT FK_C3AEF08C2BC6B0AE FOREIGN KEY (ruta_visita_id) REFERENCES ruta_visita (id)');
        $this->addSql('CREATE INDEX IDX_C3AEF08C2BC6B0AE ON ruta (ruta_visita_id)');
        $this->addSql('ALTER TABLE visita ADD ruta_visita_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A22BC6B0AE FOREIGN KEY (ruta_visita_id) REFERENCES ruta_visita (id)');
        $this->addSql('CREATE INDEX IDX_B7F148A22BC6B0AE ON visita (ruta_visita_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ruta DROP FOREIGN KEY FK_C3AEF08C2BC6B0AE');
        $this->addSql('ALTER TABLE visita DROP FOREIGN KEY FK_B7F148A22BC6B0AE');
        $this->addSql('DROP TABLE ruta_visita');
        $this->addSql('DROP INDEX IDX_C3AEF08C2BC6B0AE ON ruta');
        $this->addSql('ALTER TABLE ruta DROP ruta_visita_id');
        $this->addSql('DROP INDEX IDX_B7F148A22BC6B0AE ON visita');
        $this->addSql('ALTER TABLE visita DROP ruta_visita_id');
    }
}
