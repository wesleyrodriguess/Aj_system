<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210101213216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE administradores (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionarios (id INT NOT NULL, telefone VARCHAR(100) NOT NULL, salario NUMERIC(8, 2) NOT NULL, porcentagem INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicos (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, valor NUMERIC(8, 2) NOT NULL, solicitante VARCHAR(100) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servico_funcionarios (id INT NOT NULL, funcionarios_id INT NOT NULL, INDEX IDX_1D3BAFF7BF396750 (id), INDEX IDX_1D3BAFF75E7346C7 (funcionarios_id), PRIMARY KEY(id, funcionarios_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, reset_token LONGTEXT DEFAULT NULL, roles VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, tipo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EF687F2E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administradores ADD CONSTRAINT FK_BA7CABE6BF396750 FOREIGN KEY (id) REFERENCES usuarios (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE funcionarios ADD CONSTRAINT FK_10A00089BF396750 FOREIGN KEY (id) REFERENCES usuarios (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE servico_funcionarios ADD CONSTRAINT FK_1D3BAFF7BF396750 FOREIGN KEY (id) REFERENCES servicos (id)');
        $this->addSql('ALTER TABLE servico_funcionarios ADD CONSTRAINT FK_1D3BAFF75E7346C7 FOREIGN KEY (funcionarios_id) REFERENCES funcionarios (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servico_funcionarios DROP FOREIGN KEY FK_1D3BAFF75E7346C7');
        $this->addSql('ALTER TABLE servico_funcionarios DROP FOREIGN KEY FK_1D3BAFF7BF396750');
        $this->addSql('ALTER TABLE administradores DROP FOREIGN KEY FK_BA7CABE6BF396750');
        $this->addSql('ALTER TABLE funcionarios DROP FOREIGN KEY FK_10A00089BF396750');
        $this->addSql('DROP TABLE administradores');
        $this->addSql('DROP TABLE funcionarios');
        $this->addSql('DROP TABLE servicos');
        $this->addSql('DROP TABLE servico_funcionarios');
        $this->addSql('DROP TABLE usuarios');
    }
}
