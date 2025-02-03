<?php

namespace App\Repository;

use App\Entity\Paiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Paiement>
 *
 * @method Paiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paiement[]    findAll()
 * @method Paiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paiement::class);
    }

    // Méthode pour ajouter un paiement (comme dans le contrôleur "new")
    public function add(Paiement $paiement): void
    {
        $this->_em->persist($paiement);
        $this->_em->flush();
    }

    // Méthode pour supprimer un paiement (comme dans le contrôleur "delete")
    public function remove(Paiement $paiement): void
    {
        $this->_em->remove($paiement);
        $this->_em->flush();
    }

    // Exemple de méthode pour trouver tous les paiements pour un utilisateur spécifique
    public function findByUser($userId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Exemple de méthode personnalisée pour obtenir les paiements dans une certaine période
    public function findPaymentsInRange(\DateTime $startDate, \DateTime $endDate): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.date BETWEEN :startDate AND :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}