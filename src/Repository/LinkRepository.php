<?php

namespace App\Repository;

use App\Entity\Link;
use App\Model\Service\Redis\RedisClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Link>
 *
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    const CHUNK_SIZE = 30000;

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        ManagerRegistry $registry
    ) {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Link::class);
    }

    public function saveShortUrls(array $shortUrls): void
    {
        $i = 0;
        foreach ($shortUrls as $shortUrl) {
            $link = new Link();
            $link->setShortUrl($shortUrl);
            $this->entityManager->persist($link);
            $i++;

            if ($i === self::CHUNK_SIZE) {
                $this->entityManager->flush();
                $this->entityManager->clear();
                $i = 0;
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    public function getLinksForRedis(int $qty): array
    {
        $formattedLinks = [];
        $clientRedis = RedisClient::getRedisClient();

        $links = $this->findBy(['original_url' => null], [], $qty);

        foreach ($links as $link) {
            $formattedLinks[] = $link->getShorturl();
        }

        $clientRedis->hset('task_links', 'gen-links', '1');

        return $formattedLinks;
    }

    public function attachUrlToLink(string $url, string $link): void
    {
        $this->entityManager->createQueryBuilder()
            ->update(Link::class, 'l')
            ->set('l.original_url', '?1')
            ->where('l.short_url = ?2')
            ->setParameter(1, $url)
            ->setParameter(2, $link)
            ->getQuery()->execute();
    }
}
