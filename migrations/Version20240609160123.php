<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609160123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove presentation position from products to add it to category';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD home_position SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP presentation_position');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP home_position');
        $this->addSql('ALTER TABLE product ADD presentation_position SMALLINT DEFAULT NULL');
    }
}
