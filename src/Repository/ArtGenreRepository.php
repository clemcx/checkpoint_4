<?php

namespace App\Repository;

use App\Entity\ArtGenre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArtGenre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtGenre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtGenre[]    findAll()
 * @method ArtGenre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtGenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtGenre::class);
    }

    // /**
    //  * @return ArtGenre[] Returns an array of ArtGenre objects
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
    public function findOneBySomeField($value): ?ArtGenre
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
