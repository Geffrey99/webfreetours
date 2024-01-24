<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124094136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visita DROP FOREIGN KEY FK_B7F148A22BC6B0AE');
        $this->addSql('DROP INDEX IDX_B7F148A22BC6B0AE ON visita');
        $this->addSql('ALTER TABLE visita DROP ruta_visita_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visita ADD ruta_visita_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A22BC6B0AE FOREIGN KEY (ruta_visita_id) REFERENCES ruta_visita (id)');
        $this->addSql('CREATE INDEX IDX_B7F148A22BC6B0AE ON visita (ruta_visita_id)');
    }
}
