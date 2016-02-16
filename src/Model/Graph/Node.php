<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 03:31
 */

namespace Model\Graph;

use \Sabre\Xml\XmlDeserializable;
use \Sabre\Xml\Reader;

/**
 * Class Node
 * @package Model\Graph
 */
final class Node implements XmlDeserializable
{
    public $id;
    public $name;
    public $from;
    public $to;
    public $cost;

    /**
     * @param Reader $reader
     * @return Node
     */
    public static function xmlDeserialize(Reader $reader) {
        $node = new Node();
        // Borrowing a parser from the KeyValue class.
        $keyValue = \Sabre\Xml\Deserializer\keyValue($reader, '');

        if (isset($keyValue['id'])) {
            $node->id = $keyValue['id'];
        } else {
            unset($node->id);
        }
        if (isset($keyValue['name'])) {
            $node->name = $keyValue['name'];
        } else {
            unset($node->name);
        }
        if (isset($keyValue['from'])) {
            $node->from = $keyValue['from'];
        } else {
            unset($node->from);
        }
        if (isset($keyValue['to'])) {
            $node->to = $keyValue['to'];
        } else {
            unset($node->to);
        }
        if (isset($keyValue['cost'])) {
            $node->cost = $keyValue['cost'];
        } else {
            unset($node->cost);
        }

        return $node;
    }
}
