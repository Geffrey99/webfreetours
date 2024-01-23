<?php

namespace App\Repository;

use App\Entity\UserTour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserTour>
 *
 * @method UserTour|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTour|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTour[]    findAll()
 * @method UserTour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTour::class);
    }

//    /**
//     * @return UserTour[] Returns an array of UserTour objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserTour
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
