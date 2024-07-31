<?php

namespace App\Repository;

use App\Entity\BarangKeluar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BarangKeluar>
 *
 * @method BarangKeluar|null find($id, $lockMode = null, $lockVersion = null)
 * @method BarangKeluar|null findOneBy(array $criteria, array $orderBy = null)
 * @method BarangKeluar[]    findAll()
 * @method BarangKeluar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarangKeluarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BarangKeluar::class);
    }

    public function findAllWithBarang()
    {
      $conn = $this->getEntityManager()->getConnection();

      $sql = '
          SELECT 
              *
          FROM 
              barang b
          RIGHT JOIN 
              barang_keluar bk ON b.id_barang = bk.id_barang
      ';

      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();

      return $resultSet->fetchAllAssociative();
    }

    public function add(BarangKeluar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BarangKeluar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BarangKeluar[] Returns an array of BarangKeluar objects
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

//    public function findOneBySomeField($value): ?BarangKeluar
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
