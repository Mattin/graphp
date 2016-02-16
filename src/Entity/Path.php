<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 21:21
 */

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\Annotation;

/**
 * Entity\Path
 *
 * @ORM\Entity(
 *     repositoryClass="Repository\PathsRepository",
 *     readOnly=true
 * )
 * @ORM\Table(
 *  name="gp_paths",
 *  indexes={
 *      @ORM\Index(name="index_from", columns={"from_node"}),
 *      @ORM\Index(name="index_to", columns={"to_node"})
 *  }
 * )
 */
class Path
{
    /**
     * @var string $fromNode
     * @ORM\Id
     * @ORM\Column(name="from_node", type="text", length=1, nullable=false);
     */
    protected $fromNode;

    /**
     * @var string $toNode
     * @ORM\Id
     * @ORM\Column(name="to_node", type="text", length=1, nullable=false);
     */
    protected $toNode;

    /**
     * @var string $cost
     * @ORM\Id
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $cost;

    /**
     * @var array $path
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false)
     */
    protected $path;

    /**
     * @return string
     */
    public function getFromNode()
    {
        return $this->fromNode;
    }

    /**
     * @return string
     */
    public function getToNode()
    {
        return $this->toNode;
    }

    /**
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return array
     */
    public function getPath()
    {
        return $this->path;
    }
}