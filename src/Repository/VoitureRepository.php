<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    // Méthode personnalisée pour obtenir des voitures par marque
    public function findByMarque(string $marque)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.marque = :marque')
            ->setParameter('marque', $marque)
            ->orderBy('v.modele', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Méthode personnalisée pour obtenir des voitures avec un nombre de places supérieur à une valeur donnée
    public function findByNombrePlacesGreaterThan(int $nombrePlaces)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.nombrePlaces > :nombrePlaces')
            ->setParameter('nombrePlaces', $nombrePlaces)
            ->orderBy('v.nombrePlaces', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Méthode pour rechercher des voitures en fonction de plusieurs critères (par exemple marque et couleur)
    public function findByCriteria(string $marque, string $couleur)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.marque = :marque')
            ->andWhere('v.couleur = :couleur')
            ->setParameter('marque', $marque)
            ->setParameter('couleur', $couleur)
            ->orderBy('v.modele', 'ASC')
            ->getQuery()
            ->getResult();
    }


}