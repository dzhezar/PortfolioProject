<?php

namespace App\Repository;

use App\Entity\PhotoshotImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoshotImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoshotImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoshotImage[]    findAll()
 * @method PhotoshotImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoshotImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoshotImage::class);
    }

    // /**
    //  * @return PhotoshotImage[] Returns an array of PhotoshotImage objects
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
    public function findOneBySomeField($value): ?PhotoshotImage
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
