<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 03:41
 */

namespace Model\Graph;

use \Sabre\Xml\XmlDeserializable;
use \Sabre\Xml\Reader;

/**
 * Class Nodes
 * @package Model\Graph
 */
final class Nodes implements XmlDeserializable
{
    public $nodes = [];

    /**
     * @param Reader $reader
     * @return Nodes
     * @throws \Sabre\Xml\LibXMLException
     * @throws \Sabre\Xml\ParseException
     */
    public static function xmlDeserialize(Reader $reader) {
        $nodes = new Nodes();
        $children = $reader->parseInnerTree();
        foreach($children as $child) {
            if ($child['value'] instanceof Node) {
                $nodes->nodes[] = $child['value'];
            }
        }
        return $nodes;
    }
}