<?php

namespace App\Repository;

use App\Entity\Passager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Passager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passager[]    findAll()
 * @method Passager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passager::class);
    }

    // Exemple de méthode personnalisée : trouver les passagers actifs
    public function findActivePassagers()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.active = :active')
            ->setParameter('active', true)
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Vous pouvez ajouter d'autres méthodes personnalisées en fonction de vos besoins.
}