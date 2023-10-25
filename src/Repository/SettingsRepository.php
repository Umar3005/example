<?php

namespace App\Repository;

use App\Entity\Settings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Settings>
 *
 * @method Settings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Settings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Settings[]    findAll()
 * @method Settings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Settings::class);
    }

    public function getDelayByConnectionId(array $connectionIds = []): Query
    {
        $builder = $this->createQueryBuilder('s', 's.connection_id');
        $builder->select('s.connection_id, s.response_delay_time')
            ->where($builder->expr()->in('s.connection_id', $connectionIds))
            ->andWhere('s.send_response_with_timeout = true');

        return $builder->getQuery();
    }
}
