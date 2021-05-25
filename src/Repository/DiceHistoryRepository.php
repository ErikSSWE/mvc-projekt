<?php

namespace App\Repository;

use App\Entity\DiceHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiceHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiceHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiceHistory[]    findAll()
 * @method DiceHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiceHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiceHistory::class);
    }

    // /**
    //  * @return DiceHistory[] Returns an array of DiceHistory objects
    //  */
    
    public function getDiceField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.dice = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getSortedDiceField()
    {
        return $this->createQueryBuilder('d')
            ->select('d.dice, COUNT(d.dice) as nmbr')
            ->groupBy('d.dice')
            ->orderBy('d.dice', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?DiceHistory
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
