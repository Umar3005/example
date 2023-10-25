<?php

namespace App\Repository\Platform;

use App\Entity\Platform\TurnConnectIn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TurnConnectIn>
 *
 * @method TurnConnectIn|null find($id, $lockMode = null, $lockVersion = null)
 * @method TurnConnectIn|null findOneBy(array $criteria, array $orderBy = null)
 * @method TurnConnectIn[]    findAll()
 * @method TurnConnectIn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurnConnectInRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TurnConnectIn::class);
    }

    public function getConnectionsByConnectIds(array $connectionIds = []): Query
    {
        $builder = $this->createQueryBuilder('a', 'a.sId');
        $builder->select()
            ->where($builder->expr()->in('a.sId', $connectionIds));

        return $builder->getQuery();
    }
}
