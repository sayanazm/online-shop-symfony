<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430162137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE cart_products (id SERIAL NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2D251531A76ED395 ON cart_products (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2D2515314584665A ON cart_products (product_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE order_products (id SERIAL NOT NULL, order_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5242B8EB8D9F6D38 ON order_products (order_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5242B8EB4584665A ON order_products (product_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE orders (id SERIAL NOT NULL, user_id INT NOT NULL, phone VARCHAR(20) NOT NULL, delivery_type VARCHAR(20) NOT NULL, status VARCHAR(30) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE products (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_B3BA5A5A6DE44026 ON products (description)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products ADD CONSTRAINT FK_2D251531A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products ADD CONSTRAINT FK_2D2515314584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_products ADD CONSTRAINT FK_5242B8EB8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_products ADD CONSTRAINT FK_5242B8EB4584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products DROP CONSTRAINT FK_2D251531A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products DROP CONSTRAINT FK_2D2515314584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_products DROP CONSTRAINT FK_5242B8EB8D9F6D38
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_products DROP CONSTRAINT FK_5242B8EB4584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEEA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart_products
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE order_products
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE orders
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE products
        SQL);
    }
}
