<?php

namespace App\Repository;

use App\Entity\AccountBank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method AccountBank|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountBank|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountBank[]    findAll()
 * @method AccountBank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountBankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountBank::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(AccountBank $accountBank){
        $em = $this->getEntityManager();
        $em->persist($accountBank);
        $em->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function remove(AccountBank $accountBank){
        $accountBank->setDeletionDate(new \DateTime());
        $accountBank->getCardBank()->setDeletionDate(new \DateTime());
        $em = $this->getEntityManager();
        $em->persist($accountBank);
        $em->flush();
    }


    /**
     * @throws ORMException
     * @throws \Exception
     */
    public function update(AccountBank $newAccountBankData, AccountBank $updateAccountBank){
        $em = $this->getEntityManager();
        if ($newAccountBankData->getBalance()) $updateAccountBank->setBalance($newAccountBankData->getBalance());
        if ($newAccountBankData->getBic()) $updateAccountBank->setBic($newAccountBankData->getBic());
        if ($newAccountBankData->getIban()) $updateAccountBank->setIban($newAccountBankData->getIban());
        if ($newCardBank = $newAccountBankData->getCardBank()){
            if ($newCardBank->getNumber()) $updateAccountBank->getCardBank()->setNumber($newCardBank->getNumber());
            if ($newCardBank->getExpiryDate()) $updateAccountBank->getCardBank()->setExpiryDate($newCardBank->getExpiryDate());
            if ($newCardBank->getStatus()) $updateAccountBank->getCardBank()->setStatus($newCardBank->getStatus());
        }
        $em->persist($updateAccountBank);
        $em->flush();
        return $updateAccountBank;
    }
    // /**
    //  * @return AccountBank[] Returns an array of AccountBank objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AccountBank
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
