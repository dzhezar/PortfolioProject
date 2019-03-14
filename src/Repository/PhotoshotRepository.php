<?php

namespace App\Repository;

use App\Entity\Photoshot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Photoshot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photoshot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photoshot[]    findAll()
 * @method Photoshot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoshotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Photoshot::class);
    }

    // /**
    //  * @return Photoshot[] Returns an array of Photoshot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Photoshot
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
