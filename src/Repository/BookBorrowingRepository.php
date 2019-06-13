<?php

namespace App\Repository;

use App\Entity\BookBorrowing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookBorrowing|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookBorrowing|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookBorrowing[]    findAll()
 * @method BookBorrowing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookBorrowingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookBorrowing::class);
    }

    // /**
    //  * @return BookBorrowing[] Returns an array of BookBorrowing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookBorrowing
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
