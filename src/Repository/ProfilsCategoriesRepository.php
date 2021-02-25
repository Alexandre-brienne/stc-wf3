<?php

namespace App\Repository;

use App\Entity\ProfilsCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfilsCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilsCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilsCategories[]    findAll()
 * @method ProfilsCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilsCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilsCategories::class);
    }

    // /**
    //  * @return ProfilsCategories[] Returns an array of ProfilsCategories objects
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
    public function findOneBySomeField($value): ?ProfilsCategories
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
