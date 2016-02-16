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
 * Entity\Node
 *
 * @ORM\Entity(repositoryClass="Repository\NodesRepository")
 * @ORM\Table(
 *  name="gp_nodes",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="node_id",columns={"graph", "id"})
 *  },
 *  indexes={
 *      @ORM\Index(name="index_graph", columns={"graph", "id"})
 *  }
 * )
 */
class Node
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="string");
     */
    protected $id;

    /**
     * @var \Entity\Graph
     * @ORM\ManyToOne(targetEntity="Graph")
     * @ORM\JoinColumn(name="graph", referencedColumnName="id", nullable=true)
     */
    protected $graph;

    /**
     * @var string $name
     * @ORM\Column(type="string", nullable=false);
     */
    protected $name;

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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
