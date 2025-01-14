<?php

namespace App\Repository;

use App\Entity\ZamuaFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ZamuaFiles>
 *
 * @method ZamuaFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZamuaFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZamuaFiles[]    findAll()
 * @method ZamuaFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZamuaFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZamuaFiles::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ZamuaFiles $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ZamuaFiles $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // public function findZamuaFilesCredits()
    // {
    //     $conn = $this->getEntityManager()->getConnection();

    //     $sql = "SELECT credit FROM zamua_files";

    //     $stmt = $conn->prepare($sql);
    //     $result = $stmt->executeQuery();

    //     return $result->fetchAllAssociative();
    // }
    // /**
    //  * @return ZamuaFiles[] Returns an array of ZamuaFiles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZamuaFiles
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
