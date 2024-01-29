<?php

namespace App\Repository;

use App\Entity\TypeRealEstate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeRealEstate>
 *
 * @method TypeRealEstate|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRealEstate|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRealEstate[]    findAll()
 * @method TypeRealEstate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRealEstateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRealEstate::class);
    }

//    /**
//     * @return TypeRealEstate[] Returns an array of TypeRealEstate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeRealEstate
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
