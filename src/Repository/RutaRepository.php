<?php

namespace App\Repository;

use App\Entity\Ruta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ruta>
 *
 * @method Ruta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ruta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ruta[]    findAll()
 * @method Ruta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RutaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ruta::class);
    }

//    /**
//     * @return Ruta[] Returns an array of Ruta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ruta
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
