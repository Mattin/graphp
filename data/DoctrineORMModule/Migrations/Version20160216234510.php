<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160216234510 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->connection->executeQuery("
            CREATE VIEW gp_paths AS
                WITH RECURSIVE search_graph AS (
                    SELECT from_node, ARRAY[to_node] AS path, to_node <> from_node AS ok_go, cost, ARRAY[]::numeric[] as costs
                    FROM gp_edges

                    UNION 	ALL
                    SELECT 	g.from_node, sg.path || g.from_node, g.to_node <> g.from_node, g.cost, (sg.costs || sg.cost) as costs
                    FROM 	search_graph sg
                    JOIN 	gp_edges g ON sg.from_node = g.to_node
                    WHERE sg.ok_go
                    )
                SELECT path[array_upper(path,1)] AS from_node
                     , path[1] AS to_node
                     , path
                     , (SELECT SUM(t) FROM UNNEST(costs) t) AS cost
                FROM   search_graph
                WHERE (SELECT COUNT(t) FROM UNNEST(path) t) > 1
                ORDER  BY cost;
        ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP VIEW gp_paths');
    }
}
