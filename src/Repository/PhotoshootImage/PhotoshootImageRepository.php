<?php

namespace App\Repository\PhotoshootImage;

use App\Entity\PhotoshootImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoshootImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoshootImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoshootImage[]    findAll()
 * @method PhotoshootImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoshootImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoshootImage::class);
    }

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
