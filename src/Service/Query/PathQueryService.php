<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 13:57
 */

namespace Service\Query;

use \Repository\PathsRepository;
use \Service\ToolsService;

/**
 * Class PathQueryService
 * @package Service\Query
 */
final class PathQueryService implements QueryInterface
{
    /**
     * @Inject
     * @var PathsRepository
     */
    protected $repoPaths;

    /**
     * @Inject
     * @var ToolsService
     */
    protected $tools;

    /**
     * @param string $start
     * @param string $end
     * @return array|void
     */
    public function query($start, $end)
    {
        $results = $this->repoPaths->findBy([
            'fromNode'  => $start,
            'toNode'    => $end
        ]);

        $response = [
            'from' => $start,
            'to' => $end,
            'paths' => []
        ];

        if ($results) {
            foreach ($results as $result) {
                array_push($response['paths'], $this->tools->convertToPHPValue($result->getPath()));
            }
            return $response;
        } else {
            $response['paths'] = false;
            return $response;
        }
    }
}
