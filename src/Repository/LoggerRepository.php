<?php

namespace App\Repository;

use App\Entity\Logger;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Logger>
 *
 * @method Logger|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logger|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logger[]    findAll()
 * @method Logger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoggerRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        ManagerRegistry $registry
    ) {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Logger::class);
    }

    public function log(array $data): void
    {
        $logger = new Logger();

        foreach ($data as $field => $value) {
            $method = 'set' . ucfirst($field);
            $logger->$method($value);
        }

        $logger->setCreatedAt(new DateTimeImmutable());

        $this->entityManager->persist($logger);
        $this->entityManager->flush();
    }
}
