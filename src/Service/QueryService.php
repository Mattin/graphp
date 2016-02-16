<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 13:40
 */

namespace Service;

use \Doctrine\ORM\EntityManager;

/**
 * Class QueryService
 * @package Service
 */
final class QueryService
{
    /**
     * @var array
     */
    protected $queryArray;

    /**
     * @var string
     */
    protected $result = [
        'paths' => [],
        'cheapest' => []
    ];

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @Inject
     * @var Query\PathQueryService
     */
    protected $queryPath;

    /**
     * @Inject
     * @var Query\CheapestQueryService
     */
    protected $queryCheapest;

    /**
     * Query for each path
     * @return bool
     */
    public function query()
    {
        foreach ($this->queryArray->queries as $key => $query) {
            switch ($key) {
                case 'paths':
                    if ($result = $this->queryPath->query($query[0]->start, $query[0]->end)) {
                        array_push($this->result['paths'], $result);
                    }
                    break;
                case 'cheapest':
                    if ($result = $this->queryCheapest->query($query[0]->start, $query[0]->end)) {
                        array_push($this->result['cheapest'], $result);
                    }
                    break;
            }
        }
        if (count($this->getResult()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param \stdClass $queryArray
     * @return self
     */
    public function setQueryArray(\stdClass $queryArray)
    {
        $this->queryArray = $queryArray;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return json_encode(['answers' => $this->result]);
    }
}
