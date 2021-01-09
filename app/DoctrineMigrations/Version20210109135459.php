<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109135459 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE servico_funcionarios');
        $this->addSql('ALTER TABLE cliente CHANGE nome nome VARCHAR(100) DEFAULT NULL, CHANGE telefone telefone VARCHAR(100) DEFAULT NULL, CHANGE cidade cidade VARCHAR(100) DEFAULT NULL, CHANGE estado estado VARCHAR(100) DEFAULT NULL, CHANGE bairro bairro VARCHAR(100) DEFAULT NULL, CHANGE logradouro logradouro VARCHAR(100) DEFAULT NULL, CHANGE cep cep VARCHAR(100) DEFAULT NULL, CHANGE cpf_and_cnpj cpf_and_cnpj VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE funcionarios CHANGE telefone telefone VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE servicos ADD responsavel_id INT DEFAULT NULL, ADD cliente_id INT DEFAULT NULL, ADD status TINYINT(1) DEFAULT NULL, ADD data_finalizacao DATETIME DEFAULT NULL, CHANGE nome nome VARCHAR(100) DEFAULT NULL, CHANGE solicitante solicitante VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE servicos ADD CONSTRAINT FK_89DD09E3BB9AF004 FOREIGN KEY (responsavel_id) REFERENCES funcionarios (id)');
        $this->addSql('ALTER TABLE servicos ADD CONSTRAINT FK_89DD09E3DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_89DD09E3BB9AF004 ON servicos (responsavel_id)');
        $this->addSql('CREATE INDEX IDX_89DD09E3DE734E51 ON servicos (cliente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE servico_funcionarios (id INT NOT NULL, funcionarios_id INT NOT NULL, INDEX IDX_1D3BAFF75E7346C7 (funcionarios_id), INDEX IDX_1D3BAFF7BF396750 (id), PRIMARY KEY(id, funcionarios_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE servico_funcionarios ADD CONSTRAINT FK_1D3BAFF75E7346C7 FOREIGN KEY (funcionarios_id) REFERENCES funcionarios (id)');
        $this->addSql('ALTER TABLE servico_funcionarios ADD CONSTRAINT FK_1D3BAFF7BF396750 FOREIGN KEY (id) REFERENCES servicos (id)');
        $this->addSql('ALTER TABLE cliente CHANGE nome nome VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE telefone telefone VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE cidade cidade VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE estado estado VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE bairro bairro VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE logradouro logradouro VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE cep cep VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE cpf_and_cnpj cpf_and_cnpj VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE funcionarios CHANGE telefone telefone VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE servicos DROP FOREIGN KEY FK_89DD09E3BB9AF004');
        $this->addSql('ALTER TABLE servicos DROP FOREIGN KEY FK_89DD09E3DE734E51');
        $this->addSql('DROP INDEX IDX_89DD09E3BB9AF004 ON servicos');
        $this->addSql('DROP INDEX IDX_89DD09E3DE734E51 ON servicos');
        $this->addSql('ALTER TABLE servicos DROP responsavel_id, DROP cliente_id, DROP status, DROP data_finalizacao, CHANGE nome nome VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE solicitante solicitante VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
