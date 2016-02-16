<?php
/**
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 01:31
 */

namespace Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class EdgesRepository
 * @package Repository
 */
final class PathsRepository extends EntityRepository
{
    public function findCheapest($from, $to)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb->select(array('t'))
            ->from($this->getEntityName(), 't')
            ->where($qb->expr()->eq('t.fromNode', ':from'))
            ->andWhere($qb->expr()->eq('t.toNode', ':to'))
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->orderBy('t.cost', 'asc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
