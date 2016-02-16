<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 13:58
 */

namespace Service\Query;

use \Repository\PathsRepository;
use \Service\ToolsService;

/**
 * Class CheapestQueryService
 * @package Service\Query
 */
final class CheapestQueryService implements QueryInterface
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
        $result = $this->repoPaths->findCheapest($start, $end);

        $response = [
            'from' => $start,
            'to' => $end,
            'paths' => []
        ];

        if ($result) {
            return [
                'from' => $start,
                'to' => $end,
                'paths' => [$this->tools->convertToPHPValue($result->getPath())]
            ];
        } else {
            $response['paths'] = false;
            return $response;
        }
    }
}
