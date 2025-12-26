<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251226085643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY `FK_D0B942131DEB1EBB`');
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY `FK_D0B942139D86650F`');
        $this->addSql('DROP INDEX IDX_D0B942131DEB1EBB ON disinfections');
        $this->addSql('DROP INDEX IDX_D0B942139D86650F ON disinfections');
        $this->addSql('ALTER TABLE disinfections ADD vehicle_id INT NOT NULL, ADD user_id INT NOT NULL, DROP vehicle_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT FK_D0B94213545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT FK_D0B94213A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D0B94213545317D1 ON disinfections (vehicle_id)');
        $this->addSql('CREATE INDEX IDX_D0B94213A76ED395 ON disinfections (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY FK_D0B94213545317D1');
        $this->addSql('ALTER TABLE disinfections DROP FOREIGN KEY FK_D0B94213A76ED395');
        $this->addSql('DROP INDEX IDX_D0B94213545317D1 ON disinfections');
        $this->addSql('DROP INDEX IDX_D0B94213A76ED395 ON disinfections');
        $this->addSql('ALTER TABLE disinfections ADD vehicle_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP vehicle_id, DROP user_id');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT `FK_D0B942131DEB1EBB` FOREIGN KEY (vehicle_id_id) REFERENCES vehicle (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE disinfections ADD CONSTRAINT `FK_D0B942139D86650F` FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D0B942131DEB1EBB ON disinfections (vehicle_id_id)');
        $this->addSql('CREATE INDEX IDX_D0B942139D86650F ON disinfections (user_id_id)');
    }
}
