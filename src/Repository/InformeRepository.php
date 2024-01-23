<?php

namespace App\Repository;

use App\Entity\Informe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Informe>
 *
 * @method Informe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Informe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Informe[]    findAll()
 * @method Informe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Informe::class);
    }

//    /**
//     * @return Informe[] Returns an array of Informe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Informe
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
