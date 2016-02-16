<?php
/**
 * Created by Matus Nickel
 * Date: 15/02/16
 * Time: 18:40
 */

namespace Service;

use Model\Graph\Edges;
use Model\Graph\Graph;
use Model\Graph\Node;
use Model\Graph\Nodes;
use \Sabre\Xml\Reader;
use \Sabre\Xml\Service;
use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\ORMException;

/**
 * Class ImportService
 * @package Service
 */
final class ImportService
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var
     */
    protected $service;

    /**
     * ImportService constructor.
     * @param EntityManager $em
     * @param Reader $reader
     * @param Service $service
     */
    public function __construct(
        EntityManager $em,
        Reader $reader,
        Service $service
    ) {
        $this->em = $em;
        $this->reader = $reader;
        $this->service = $service;
    }

    /**
     * @return bool|void
     * @throws \Sabre\Xml\LibXMLException
     */
    public function import()
    {
        $this->isXmlValid($this->file);

        $this->service->elementMap = [
            '{}graph' => Graph::class,
            '{}nodes' => Nodes::class,
            '{}edges' => Edges::class,
            '{}node' => Node::class,
        ];

        $result = $this->service->parse($this->file);

        try {
            $graphEntity = $this->importGraph($result);
            $this->importNodes($result, $graphEntity);
            $this->importEdges($result, $graphEntity);
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }

    /**
     * Validate file input against xsd schema
     * @param $file
     */
    private function isXmlValid($file)
    {
        $this->reader->XML($file);
        $this->reader->setSchema(ROOT.'/data/graph_xml_input.xsd');
        $this->reader->isValid();
    }

    /**
     * @param Graph $data
     * @return \Entity\Graph
     */
    private function importGraph(Graph $data)
    {
        $graphEntity = new \Entity\Graph();
        $graphEntity->setId($data->id)
            ->setName($data->name);
        $this->em->merge($graphEntity);
        $this->em->flush();

        return $graphEntity;
    }

    /**
     * @param Graph $data
     * @param \Entity\Graph $graphEntity
     */
    private function importNodes(Graph $data, \Entity\Graph $graphEntity)
    {
        if ($data->nodes instanceof Nodes){
            foreach ($data->nodes->nodes as $node) {
                $nodeEntity = new \Entity\Node();
                $nodeEntity->setId($node->id)
                    ->setName($node->name)
                    ->setGraph($graphEntity);
                $this->em->merge($nodeEntity);
            }
        }
        $this->em->flush();
    }

    /**
     * @param Graph $data
     * @param \Entity\Graph $graphEntity
     */
    private function importEdges(Graph $data, \Entity\Graph $graphEntity)
    {
        if ($data->edges instanceof Edges){
            foreach ($data->edges->edges as $node) {
                $edgeEntity = new \Entity\Edge();
                $edgeEntity->setId($node->id)
                    ->setFromNode($node->from)
                    ->setToNode($node->to)
                    ->setCost($node->cost)
                    ->setGraph($graphEntity);
                $this->em->merge($edgeEntity);
            }
        }
        $this->em->flush();
    }

    /**
     * @param string $file
     * @return self
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
}
