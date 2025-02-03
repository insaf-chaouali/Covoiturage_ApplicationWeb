<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    // Exemple de méthode personnalisée : trouver les réservations actives
    public function findActiveReservations()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.active = :active')
            ->setParameter('active', true)
            ->orderBy('r.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}