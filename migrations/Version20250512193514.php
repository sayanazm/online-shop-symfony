<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512193514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE products ADD measurements JSON NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ADD version INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ALTER description TYPE TEXT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ALTER description DROP NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE products DROP measurements
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products DROP version
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ALTER description TYPE VARCHAR(255)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ALTER description SET NOT NULL
        SQL);
    }
}
