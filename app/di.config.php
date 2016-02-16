<?php
/**
 * Created by Matus Nickel
 * Date: 12/02/16
 * Time: 00:11
 */

use DI\Container;
use Doctrine\ORM\EntityManager;

return [
    /** Entity managers */
    'em' => \DI\get('orm.em'),

    /** Repositories */
    \Repository\GraphsRepository::class => DI\factory(
        function (Container $c) {
            return $c->get('em')->getRepository(\Entity\Graph::class);
        }
    ),
    \Repository\EdgesRepository::class => DI\factory(
        function (Container $c) {
            return $c->get('em')->getRepository(\Entity\Edge::class);
        }
    ),
    \Repository\NodesRepository::class => DI\factory(
        function (Container $c) {
            return $c->get('em')->getRepository(\Entity\Node::class);
        }
    ),
    \Repository\PathsRepository::class => DI\factory(
        function (Container $c) {
            return $c->get('em')->getRepository(\Entity\Path::class);
        }
    ),

    /** Services */
    \Service\ImportService::class => DI\factory(
        function (Container $c) {
            return new \Service\ImportService(
                $c->get('em'),
                $c->get(\Sabre\Xml\Reader::class),
                $c->get(\Sabre\Xml\Service::class)
            );
        }
    )
];
