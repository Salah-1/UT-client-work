<?php

namespace App\Repository;

use App\Entity\Shortener;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shortener|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shortener|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shortener[]    findAll()
 * @method Shortener[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShortenerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shortener::class);
    }

    // /**
    //  * @return Shortener[] Returns an array of Shortener objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shortener
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
