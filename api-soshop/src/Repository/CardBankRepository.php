<?php

namespace App\Repository;

use App\Entity\CardBank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CardBank|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardBank|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardBank[]    findAll()
 * @method CardBank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardBankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardBank::class);
    }

    // /**
    //  * @return CardBank[] Returns an array of CardBank objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CardBank
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
