<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251211223519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disinfections (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, disinfection_type VARCHAR(255) NOT NULL, vehicle_id_id INT NOT NULL, user_id_id INT NOT NULL, INDEX IDX_D0B942131DEB1EBB (vehicle_id_id), INDEX IDX_D0B942139D86650F (user_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE inventory_item (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(255) NOT NULL, quantity INT NOT NULL, restock_threshold INT NOT NULL, company_id_id INT NOT NULL, INDEX IDX_55BDEA3038B53C32 (company_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, company_id_id INT NOT NULL, INDEX IDX_527EDB2538B53C32 (company_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT FK_D0B942131DEB1EBB FOREIGN KEY (vehicle_id_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT FK_D0B942139D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inventory_item ADD CONSTRAINT FK_55BDEA3038B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2538B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY FK_D0B942131DEB1EBB');
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY FK_D0B942139D86650F');
        $this->addSql('ALTER TABLE inventory_item DROP FOREIGN KEY FK_55BDEA3038B53C32');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2538B53C32');
        $this->addSql('DROP TABLE disinfections');
        $this->addSql('DROP TABLE inventory_item');
        $this->addSql('DROP TABLE task');
    }
}
