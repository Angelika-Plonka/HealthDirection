<?php

namespace App\Repository;

use App\Entity\BasicInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BasicInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasicInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasicInformation[]    findAll()
 * @method BasicInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasicInformationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BasicInformation::class);
    }

    // /**
    //  * @return BasicInformation[] Returns an array of BasicInformation objects
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
    public function findOneBySomeField($value): ?BasicInformation
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
