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


    // public function findVisitasByLocalidadAndNombre($localidad, $nombre): array
    // {
    //     return $this->createQueryBuilder('v')
    //         ->select('v.foto', 'v.nombre', 'v.descripcion')
    //         ->andWhere('v.cod_localidad = :localidad')
    //         ->andWhere('v.nombre = :nombre')
    //         ->setParameter('localidad', $localidad)
    //         ->setParameter('nombre', $nombre)
    //         ->getQuery()
    //         ->getResult();
    // }
    

    public function findAllVisitas(): array
{
    return $this->createQueryBuilder('v')
        ->select('v.foto', 'v.nombre', 'v.descripcion')
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
