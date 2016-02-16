<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 14:28
 */

namespace Service\Query;

/**
 * Interface QueryInterface
 * @package Service\Query
 */
interface QueryInterface
{
    /**
     * @param string $start
     * @param string $end
     * @return array|void
     */
    public function query($start, $end);
}
