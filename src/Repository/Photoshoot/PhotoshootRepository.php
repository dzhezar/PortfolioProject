<?php

namespace App\Repository\Photoshoot;

use App\Entity\Photoshoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Photoshoot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photoshoot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photoshoot[]    findAll()
 * @method Photoshoot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoshootRepository extends ServiceEntityRepository implements PhotoshootRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Photoshoot::class);
    }

    public function FindNumberOfPhotoshoots(int $count)
    {
        return $this->createQueryBuilder('p')
            ->where('p.IsPosted = 1')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }

    public function FindPhotoshootsWithImages()
    {
        return $this->createQueryBuilder('p')
            ->where('p.IsPosted = 1')
            ->orderBy('p.PublicationDate','DESC')
            ->getQuery()
            ->getResult();
    }
}
