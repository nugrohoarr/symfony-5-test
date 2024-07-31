<?php

namespace App\Repository;

use App\Entity\BarangMasuk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BarangMasuk>
 *
 * @method BarangMasuk|null find($id, $lockMode = null, $lockVersion = null)
 * @method BarangMasuk|null findOneBy(array $criteria, array $orderBy = null)
 * @method BarangMasuk[]    findAll()
 * @method BarangMasuk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarangMasukRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BarangMasuk::class);
    }

    public function add(BarangMasuk $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BarangMasuk $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BarangMasuk[] Returns an array of BarangMasuk objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BarangMasuk
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
