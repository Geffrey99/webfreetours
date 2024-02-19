<?php

namespace App\Repository;

use App\Entity\Visita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visita>
 *
 * @method Visita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visita[]    findAll()
 * @method Visita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visita::class);
    }


    // public function findVisitasByLocalidad($localidadId)
    // {
    //     return $this->createQueryBuilder('v')
    //         ->innerJoin('v.cod_localidad', 'l')
    //         ->where('l.id = :localidadId')
    //         ->setParameter('localidadId', $localidadId)
    //         ->select('v.nombre as visita_nombre', 'l.nombre as localidad_nombre')
    //         ->getQuery()
    //         ->getResult();
    // }
    

    public function findVisitasByLocalidad($localidadId)
    {
        return $this->createQueryBuilder('v')
            ->innerJoin('v.cod_localidad', 'l')
            ->where('l.id = :localidadId')
            ->setParameter('localidadId', $localidadId)
            ->getQuery()
            ->getResult();
    }

    

public function findAllVisitas(): array
{
    return $this->createQueryBuilder('v')
        ->select('v.id','v.foto', 'v.nombre', 'v.descripcion', 'l.id as cod_localidad')
        ->join('v.cod_localidad', 'l')
        ->getQuery()
        ->getResult();
}





//    /**
//     * @return Visita[] Returns an array of Visita objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Visita
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
