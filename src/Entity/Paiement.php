<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reservationRef = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $methode = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    // Le côté inverse de la relation
    #[ORM\OneToOne(mappedBy: 'paiement', cascade: ['persist', 'remove'])]
    private ?Reservation $reservationn = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationRef(): ?string
    {
        return $this->reservationRef;
    }

    public function setReservationRef(string $reservationRef): static
    {
        $this->reservationRef = $reservationRef;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $datePaiement): static
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    public function getMethode(): ?string
    {
        return $this->methode;
    }

    public function setMethode(string $methode): static
    {
        $this->methode = $methode;

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

    public function getReservationn(): ?Reservation
    {
        return $this->reservationn;
    }

    public function setReservationn(Reservation $reservationn): static
    {
        // set the owning side of the relation if necessary
        if ($reservationn->getPaiement() !== $this) {
            $reservationn->setPaiement($this);
        }

        $this->reservationn = $reservationn;

        return $this;
    }
}

