<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251211222838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_documents (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, filepath VARCHAR(255) NOT NULL, company_id_id INT NOT NULL, INDEX IDX_91ABF87838B53C32 (company_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_documents (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, filepath VARCHAR(255) NOT NULL, user_id_id INT NOT NULL, INDEX IDX_A250FF6C9D86650F (user_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE company_documents ADD CONSTRAINT FK_91ABF87838B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user_documents ADD CONSTRAINT FK_A250FF6C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_documents DROP FOREIGN KEY FK_91ABF87838B53C32');
        $this->addSql('ALTER TABLE user_documents DROP FOREIGN KEY FK_A250FF6C9D86650F');
        $this->addSql('DROP TABLE company_documents');
        $this->addSql('DROP TABLE user_documents');
    }
}
