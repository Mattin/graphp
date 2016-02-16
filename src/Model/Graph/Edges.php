<?php
/**
 * Pixel Federation s.r.o
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 03:33
 */

namespace Model\Graph;

use \Sabre\Xml\XmlDeserializable;
use \Sabre\Xml\Reader;

/**
 * Class Edges
 * @package Model\Graph
 */
final class Edges implements XmlDeserializable
{
    public $edges = [];

    /**
     * @param Reader $reader
     * @return Edges
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    public static function xmlDeserialize(Reader $reader) {
        $edges = new Edges();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Node) {
                $edges->edges[] = $child['value'];
            }
        }
        return $edges;
    }
}