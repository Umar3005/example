<?php

namespace App\Repository\Main;

use App\Entity\Main\Links;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Links>
 *
 * @method Links|null find($id, $lockMode = null, $lockVersion = null)
 * @method Links|null findOneBy(array $criteria, array $orderBy = null)
 * @method Links[]    findAll()
 * @method Links[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Links::class);
    }
}
