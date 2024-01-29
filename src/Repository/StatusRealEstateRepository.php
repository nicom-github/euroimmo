<?php

namespace App\Repository;

use App\Entity\StatusRealEstate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusRealEstate>
 *
 * @method StatusRealEstate|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusRealEstate|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusRealEstate[]    findAll()
 * @method StatusRealEstate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusRealEstateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusRealEstate::class);
    }

//    /**
//     * @return StatusRealEstate[] Returns an array of StatusRealEstate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatusRealEstate
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
