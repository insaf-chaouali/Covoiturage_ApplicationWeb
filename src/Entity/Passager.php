<?php

namespace App\Entity;

use App\Repository\PassagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassagerRepository::class)]
//#[ORM\Table(name: 'passager')]
//#[ORM\InheritanceType('JOINED')] // Utiliser un mapping JOINED pour l'héritage
////#[ORM\DiscriminatorColumn(name: 'user_type', type: 'string')] // Discriminateur
//#[ORM\DiscriminatorMap(['user' => User::class, 'passager' => Passager::class])]
class Passager extends User
{
 //   #[ORM\Column(type: Types::FLOAT, nullable: true)] // Ajout de la colonne pour noteMoyenne
   // private ?float $noteMoyenne = null;

//    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $historiqueReservations = [];

    /**
     * @var Collection<int, Feedback>
     */
    #[ORM\OneToMany(targetEntity: Feedback::class, mappedBy: 'pasu')]
    private Collection $feedback;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'pasu')]
    private Collection $reservations;

    public function __construct()
    {

        $this->feedback = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getNoteMoyenne(): ?float
    {
        return $this->noteMoyenne;
    }

    public function setNoteMoyenne(?float $noteMoyenne): static
    {
        $this->noteMoyenne = $noteMoyenne;

        return $this;
    }

    public function getHistoriqueReservations(): array
    {
        return $this->historiqueReservations;
    }

    public function setHistoriqueReservations(array $historiqueReservations): static
    {
        $this->historiqueReservations = $historiqueReservations;

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): static
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback->add($feedback);
            $feedback->setPassager($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): static
    {
        if ($this->feedback->removeElement($feedback)) {
            if ($feedback->getPassager() === $this) {
                $feedback->setPassager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setPassager($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            if ($reservation->getPassager() === $this) {
                $reservation->setPassager(null);
            }
        }

        return $this;
    }
}
