<?php

namespace App\Repository;

use App\Entity\ArtType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArtType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtType[]    findAll()
 * @method ArtType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtType::class);
    }

    // /**
    //  * @return ArtType[] Returns an array of ArtType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArtType
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
