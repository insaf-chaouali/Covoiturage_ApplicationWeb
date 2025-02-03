<?php

namespace App\Repository;

use App\Entity\Feedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Feedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feedback[]    findAll()
 * @method Feedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feedback::class);
    }

    // Méthode personnalisée pour obtenir des feedbacks par type
    public function findByType(string $type)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.type = :type')
            ->setParameter('type', $type)
            ->orderBy('f.createdAt', 'DESC') // Tri par date de création
            ->getQuery()
            ->getResult();
    }

    // Méthode personnalisée pour obtenir des feedbacks récents
    public function findRecentFeedbacks()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.createdAt > :date')
            ->setParameter('date', new \DateTime('-30 days')) // Feedbacks des 30 derniers jours
            ->orderBy('f.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Méthode personnalisée pour obtenir un feedback en fonction de l'ID utilisateur
    public function findByUserId(int $userId)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('f.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Méthode pour rechercher des feedbacks en fonction de plusieurs critères
    public function findByCriteria(string $type, \DateTime $startDate, \DateTime $endDate)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.type = :type')
            ->andWhere('f.createdAt BETWEEN :startDate AND :endDate')
            ->setParameter('type', $type)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('f.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Méthode pour obtenir le nombre total de feedbacks
    public function countFeedbacks()
    {
        return $this->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}