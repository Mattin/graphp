<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 03:29
 */

namespace Model\Graph;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

/**
 * Class Graph
 * @package Model\Graph
 */
final class Graph implements XmlDeserializable
{
    public $id;
    public $name;
    public $nodes = [];
    public $edges = [];

    /**
     * @param Reader $reader
     * @return Graph
     */
    public static function xmlDeserialize(Reader $reader)
    {
        $graph = new Graph();
        // Borrowing a parser from the KeyValue class.
        $keyValue = \Sabre\Xml\Deserializer\keyValue($reader, '');

        if (isset($keyValue['id'])) {
            $graph->id = $keyValue['id'];
        }
        if (isset($keyValue['name'])) {
            $graph->name = $keyValue['name'];
        }
        if (isset($keyValue['nodes'])) {
            $graph->nodes = $keyValue['nodes'];
        }
        if (isset($keyValue['edges'])) {
            $graph->edges = $keyValue['edges'];
        }

        return $graph;
    }
}
