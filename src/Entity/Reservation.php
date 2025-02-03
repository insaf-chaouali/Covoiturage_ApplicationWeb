<?php
namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $trajetDescription = null;

    #[ORM\ManyToOne(targetEntity: Passager::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Passager $passager = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(targetEntity: Trajet::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trajet $trajet = null;
    // Le côté propriétaire de la relation
    #[ORM\OneToOne(targetEntity: Paiement::class, inversedBy: 'reservationn', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]  // Cette colonne est responsable de la jointure
    private ?Paiement $paiement = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrajetDescription(): ?string
    {
        return $this->trajetDescription;
    }

    public function setTrajetDescription(string $trajetDescription): static
    {
        $this->trajetDescription = $trajetDescription;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): static
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getPassager(): ?Passager
    {
        return $this->passager;
    }

    public function setPassager(?Passager $passager): static
    {
        $this->passager = $passager;

        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?Trajet $trajet): static
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(Paiement $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }
}
