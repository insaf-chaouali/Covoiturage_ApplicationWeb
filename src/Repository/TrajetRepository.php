<?php

// src/Repository/TrajetRepository.php

namespace App\Repository;

use App\Entity\Trajet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trajet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajet[]    findAll()
 * @method Trajet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

    // Exemple de méthode personnalisée : trouver les trajets d'un utilisateur
    public function findByUser($userId)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.user = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('t.departureTime', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Exemple de méthode personnalisée : trouver les trajets à venir
    public function findUpcomingTrajets()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.departureTime > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('t.departureTime', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Récupérer tous les trajets
    public function findAllTrajets(): array
    {
        return $this->findAll();
    }

    // Exemple de méthode personnalisée : trouver les trajets par ville de départ
    public function findByVilleDepart(string $villeDepart)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.pointDepart = :villeDepart')
            ->setParameter('villeDepart', $villeDepart)
            ->getQuery()
            ->getResult();
    }

}
