<?php

namespace App\Repository;

use App\Entity\BarangMasuk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

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

    // private function createQueryBuilderWithJoin(): QueryBuilder
    // {
    //     return $this->createQueryBuilder('bm')
    //         ->select('bm', 'b')
    //         ->join('bm.barang', 'b');
    // }

    // public function findAll(): array
    // {
    //     return $this->createQueryBuilderWithJoin()
    //         ->getQuery()
    //         ->getResult();
    // }

    // public function find($id, $lockMode = null, $lockVersion = null): ?BarangMasuk
    // {
    //     return $this->createQueryBuilderWithJoin()
    //         ->andWhere('bm.id_masuk = :id')
    //         ->setParameter('id', $id)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }

    // public function findOneBy(array $criteria, array $orderBy = null): ?BarangMasuk
    // {
    //     $queryBuilder = $this->createQueryBuilderWithJoin();

    //     foreach ($criteria as $key => $value) {
    //         $queryBuilder->andWhere("bm.$key = :$key")
    //             ->setParameter($key, $value);
    //     }

    //     if ($orderBy) {
    //         foreach ($orderBy as $key => $value) {
    //             $queryBuilder->addOrderBy("bm.$key", $value);
    //         }
    //     }

    //     return $queryBuilder->getQuery()
    //         ->getOneOrNullResult();
    // }

    // public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    // {
    //     $queryBuilder = $this->createQueryBuilderWithJoin();

    //     foreach ($criteria as $key => $value) {
    //         $queryBuilder->andWhere("bm.$key = :$key")
    //             ->setParameter($key, $value);
    //     }

    //     if ($orderBy) {
    //         foreach ($orderBy as $key => $value) {
    //             $queryBuilder->addOrderBy("bm.$key", $value);
    //         }
    //     }

    //     if ($limit !== null) {
    //         $queryBuilder->setMaxResults($limit);
    //     }

    //     if ($offset !== null) {
    //         $queryBuilder->setFirstResult($offset);
    //     }

    //     return $queryBuilder->getQuery()
    //         ->getResult();
    // }

    public function findAllWithBarang()
    {
      $conn = $this->getEntityManager()->getConnection();

      $sql = '
          SELECT 
              *
          FROM 
              barang b
          RIGHT JOIN 
              barang_masuk bm ON b.id_barang = bm.id_barang
      ';

      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();

      return $resultSet->fetchAllAssociative();
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
