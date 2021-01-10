<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110211744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contas_a_pagar (id INT AUTO_INCREMENT NOT NULL, funcionario_id INT DEFAULT NULL, nome VARCHAR(100) DEFAULT NULL, tipo VARCHAR(100) DEFAULT NULL, status INT DEFAULT NULL, descricao VARCHAR(100) DEFAULT NULL, valor NUMERIC(10, 2) NOT NULL, updated DATETIME DEFAULT NULL, created DATETIME DEFAULT NULL, INDEX IDX_D9352984642FEB76 (funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contas_a_pagar ADD CONSTRAINT FK_D9352984642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionarios (id)');
        $this->addSql('ALTER TABLE funcionarios DROP salario, DROP salario_mensal');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contas_a_pagar');
        $this->addSql('ALTER TABLE funcionarios ADD salario NUMERIC(8, 2) DEFAULT NULL, ADD salario_mensal NUMERIC(8, 2) DEFAULT NULL');
    }
}
