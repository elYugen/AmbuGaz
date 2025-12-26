<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251226083055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, mail VARCHAR(255) NOT NULL, siret VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE company_documents (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, filepath VARCHAR(255) NOT NULL, company_id INT NOT NULL, INDEX IDX_91ABF878979B1AD6 (company_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE disinfections (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, disinfection_type VARCHAR(255) NOT NULL, vehicle_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D0B94213545317D1 (vehicle_id), INDEX IDX_D0B94213A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE inventory_item (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(255) NOT NULL, quantity INT NOT NULL, restock_threshold INT NOT NULL, company_id INT NOT NULL, INDEX IDX_55BDEA30979B1AD6 (company_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, company_id INT NOT NULL, INDEX IDX_527EDB25979B1AD6 (company_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, company_id INT NOT NULL, INDEX IDX_8D93D649979B1AD6 (company_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_documents (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, filepath VARCHAR(255) NOT NULL, user_id_id INT NOT NULL, INDEX IDX_A250FF6C9D86650F (user_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, license_plate VARCHAR(20) NOT NULL, model VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, year_of_service INT NOT NULL, technical_inspection_date DATE NOT NULL, insurance_date DATE NOT NULL, company_id INT NOT NULL, INDEX IDX_1B80E486979B1AD6 (company_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE company_documents ADD CONSTRAINT FK_91ABF878979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT FK_D0B94213545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT FK_D0B94213A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inventory_item ADD CONSTRAINT FK_55BDEA30979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user_documents ADD CONSTRAINT FK_A250FF6C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_documents DROP FOREIGN KEY FK_91ABF878979B1AD6');
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY FK_D0B94213545317D1');
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY FK_D0B94213A76ED395');
        $this->addSql('ALTER TABLE inventory_item DROP FOREIGN KEY FK_55BDEA30979B1AD6');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE user_documents DROP FOREIGN KEY FK_A250FF6C9D86650F');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_documents');
        $this->addSql('DROP TABLE disinfections');
        $this->addSql('DROP TABLE inventory_item');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_documents');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
