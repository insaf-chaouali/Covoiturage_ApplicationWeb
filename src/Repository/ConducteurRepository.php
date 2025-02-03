<?php

namespace App\Repository;

use App\Entity\Conducteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conducteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conducteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conducteur[]    findAll()
 * @method Conducteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConducteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conducteur::class);
    }

    // Méthode personnalisée pour obtenir des conducteurs par nom
    public function findByNom(string $nom)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nom = :nom')
            ->setParameter('nom', $nom)
            ->orderBy('c.prenom', 'ASC') // You can change the sorting as needed
            ->getQuery()
            ->getResult();
    }

    // Méthode personnalisée pour obtenir des conducteurs par statut
    public function findByStatut(string $statut)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.statut = :statut')
            ->setParameter('statut', $statut)
            ->orderBy('c.nom', 'ASC') // Adjust sorting as needed
            ->getQuery()
            ->getResult();
    }

    // Méthode pour rechercher des conducteurs en fonction de plusieurs critères (par exemple, nom et statut)
    public function findByCriteria(string $nom, string $statut)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nom = :nom')
            ->andWhere('c.statut = :statut')
            ->setParameter('nom', $nom)
            ->setParameter('statut', $statut)
            ->orderBy('c.prenom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Méthode personnalisée pour trouver les conducteurs disponibles
    public function findAvailableConducteurs()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.statut = :statut')
            ->setParameter('statut', 'Disponible') // Assuming "Disponible" means available
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}