<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160216234444 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE gp_edges (id VARCHAR(2) NOT NULL, graph VARCHAR(255) DEFAULT NULL, from_node TEXT NOT NULL, to_node TEXT NOT NULL, cost NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D734E66A94505DC ON gp_edges (graph)');
        $this->addSql('CREATE INDEX index_from ON gp_edges (from_node)');
        $this->addSql('CREATE INDEX index_to ON gp_edges (to_node)');
        $this->addSql('CREATE UNIQUE INDEX edge_id ON gp_edges (graph, id)');
        $this->addSql('CREATE TABLE gp_graphs (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX graph_id ON gp_graphs (id)');
        $this->addSql('CREATE TABLE gp_nodes (id VARCHAR(255) NOT NULL, graph VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75A3EE2394505DC ON gp_nodes (graph)');
        $this->addSql('CREATE UNIQUE INDEX node_id ON gp_nodes (graph, id)');
        $this->addSql('ALTER TABLE gp_edges ADD CONSTRAINT FK_D734E66A94505DC FOREIGN KEY (graph) REFERENCES gp_graphs (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gp_nodes ADD CONSTRAINT FK_75A3EE2394505DC FOREIGN KEY (graph) REFERENCES gp_graphs (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE gp_edges DROP CONSTRAINT FK_D734E66A94505DC');
        $this->addSql('ALTER TABLE gp_nodes DROP CONSTRAINT FK_75A3EE2394505DC');
        $this->addSql('DROP TABLE gp_edges');
        $this->addSql('DROP TABLE gp_graphs');
        $this->addSql('DROP TABLE gp_nodes');
    }
}
