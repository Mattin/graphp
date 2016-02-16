<?php
/**
 * Created by Matus Nickel
 * Date: 15/02/16
 * Time: 22:47
 */

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\Annotation;
use Model\Graph\Graph;

/**
 * Entity\Edge
 *
 * @ORM\Entity(repositoryClass="Repository\EdgesRepository")
 * @ORM\Table(
 *  name="gp_edges",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="edge_id",columns={"graph", "id"})
 *  },
 *  indexes={
 *      @ORM\Index(name="index_edge", columns={"graph", "id"}),
 *      @ORM\Index(name="index_from", columns={"from_node"}),
 *      @ORM\Index(name="index_to", columns={"to_node"})
 *  }
 * )
 */
class Edge
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="string", length=2);
     */
    protected $id;

    /**
     * @var \Entity\Graph
     * @ORM\ManyToOne(targetEntity="Graph")
     * @ORM\JoinColumn(name="graph", referencedColumnName="id", nullable=true)
     */
    protected $graph;

    /**
     * @var string $fromNode
     * @ORM\Column(name="from_node", type="text", length=1, nullable=false);
     */
    protected $fromNode;

    /**
     * @var string $toNode
     * @ORM\Column(name="to_node", type="text", length=1, nullable=false);
     */
    protected $toNode;

    /**
     * @var string $cost
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $cost;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromNode()
    {
        return $this->fromNode;
    }

    /**
     * @param string $fromNode
     * @return self
     */
    public function setFromNode($fromNode)
    {
        $this->fromNode = $fromNode;
        return $this;
    }

    /**
     * @return string
     */
    public function getToNode()
    {
        return $this->toNode;
    }

    /**
     * @param string $toNode
     * @return self
     */
    public function setToNode($toNode)
    {
        $this->toNode = $toNode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     * @return self
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return Graph
     */
    public function getGraph()
    {
        return $this->graph;
    }

    /**
     * @param \Entity\Graph $graph
     * @return self
     */
    public function setGraph(\Entity\Graph $graph)
    {
        $this->graph = $graph;
        return $this;
    }
}
