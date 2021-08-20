<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user){
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }

    public function remove(User $user){
        $em = $this->getEntityManager();
        $em->remove($user);
        $em->flush();
    }

    public function update(User $newUserData, User $updateUser){
        $em = $this->getEntityManager();
        if ($newUserData->getEmail()) $updateUser->setEmail($newUserData->getEmail());
        if ($newUserData->getName()) $updateUser->setName($newUserData->getName());
        if ($newUserData->getSurname()) $updateUser->setSurname($newUserData->getSurname());
        if ($newUserData->getPhone()) $updateUser->setPhone($newUserData->getPhone());
        $em->persist($updateUser);
        $em->flush();

        return $updateUser;
    }


    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}