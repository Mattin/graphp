<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 22:20
 */

namespace Service;

/**
 * Class ToolsService
 * @package Service
 */
class ToolsService
{
    /**
     * Converts a value from its database representation to its PHP representation
     * of this type.
     *
     * @param mixed            $value    The value to convert.
     *
     * @return mixed The PHP representation of the value.
     */
    public function convertToPHPValue($value)
    {
        $value = trim($value, '{}');

        if ($value === '') {
            return array();
        }

        $array = explode(',', $value);
        $result = [];
        array_push($result, end($array));
        for($i=0; $i<count($array)-1; $i++){
            array_push($result, prev($array));
        }
        return $result;
    }
}
