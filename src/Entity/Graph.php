<?php
/**
 * Created by Matus Nickel
 * Date: 15/02/16
 * Time: 22:47
 */

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\Annotation;

/**
 * Entity\Graph
 *
 * @ORM\Entity(repositoryClass="Repository\GraphsRepository")
 * @ORM\Table(
 *  name="gp_graphs",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="graph_id",columns={"id"})
 *  },
 *  indexes={
 *      @ORM\Index(name="index_graph", columns={"id"})
 *  }
 * )
 */
class Graph
{
    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="string");
     */
    protected $id;

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
