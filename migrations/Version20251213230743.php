<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251213230743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_documents DROP FOREIGN KEY `FK_91ABF87838B53C32`');
        $this->addSql('DROP INDEX IDX_91ABF87838B53C32 ON company_documents');
        $this->addSql('ALTER TABLE company_documents CHANGE company_id_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_documents ADD CONSTRAINT FK_91ABF878979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_91ABF878979B1AD6 ON company_documents (company_id)');
        $this->addSql('ALTER TABLE inventory_item DROP FOREIGN KEY `FK_55BDEA3038B53C32`');
        $this->addSql('DROP INDEX IDX_55BDEA3038B53C32 ON inventory_item');
        $this->addSql('ALTER TABLE inventory_item CHANGE company_id_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_item ADD CONSTRAINT FK_55BDEA30979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_55BDEA30979B1AD6 ON inventory_item (company_id)');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY `FK_527EDB2538B53C32`');
        $this->addSql('DROP INDEX IDX_527EDB2538B53C32 ON task');
        $this->addSql('ALTER TABLE task CHANGE company_id_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25979B1AD6 ON task (company_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY `FK_8D93D64938B53C32`');
        $this->addSql('DROP INDEX IDX_8D93D64938B53C32 ON user');
        $this->addSql('ALTER TABLE user CHANGE company_id_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649979B1AD6 ON user (company_id)');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY `FK_1B80E48638B53C32`');
        $this->addSql('DROP INDEX IDX_1B80E48638B53C32 ON vehicle');
        $this->addSql('ALTER TABLE vehicle CHANGE company_id_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486979B1AD6 ON vehicle (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_documents DROP FOREIGN KEY FK_91ABF878979B1AD6');
        $this->addSql('DROP INDEX IDX_91ABF878979B1AD6 ON company_documents');
        $this->addSql('ALTER TABLE company_documents CHANGE company_id company_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE company_documents ADD CONSTRAINT `FK_91ABF87838B53C32` FOREIGN KEY (company_id_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_91ABF87838B53C32 ON company_documents (company_id_id)');
        $this->addSql('ALTER TABLE inventory_item DROP FOREIGN KEY FK_55BDEA30979B1AD6');
        $this->addSql('DROP INDEX IDX_55BDEA30979B1AD6 ON inventory_item');
        $this->addSql('ALTER TABLE inventory_item CHANGE company_id company_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_item ADD CONSTRAINT `FK_55BDEA3038B53C32` FOREIGN KEY (company_id_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_55BDEA3038B53C32 ON inventory_item (company_id_id)');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25979B1AD6');
        $this->addSql('DROP INDEX IDX_527EDB25979B1AD6 ON task');
        $this->addSql('ALTER TABLE task CHANGE company_id company_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT `FK_527EDB2538B53C32` FOREIGN KEY (company_id_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_527EDB2538B53C32 ON task (company_id_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('DROP INDEX IDX_8D93D649979B1AD6 ON user');
        $this->addSql('ALTER TABLE user CHANGE company_id company_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT `FK_8D93D64938B53C32` FOREIGN KEY (company_id_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D64938B53C32 ON user (company_id_id)');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486979B1AD6');
        $this->addSql('DROP INDEX IDX_1B80E486979B1AD6 ON vehicle');
        $this->addSql('ALTER TABLE vehicle CHANGE company_id company_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT `FK_1B80E48638B53C32` FOREIGN KEY (company_id_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1B80E48638B53C32 ON vehicle (company_id_id)');
    }
}
