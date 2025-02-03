<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $emetteur = null;

    #[ORM\Column(length: 255)]
    private ?string $receveur = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datefeedback = null;

    // Une seule relation avec `Passager`, représentant l'émetteur
    #[ORM\ManyToOne(inversedBy: 'feedbacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Passager $emetteurPassager = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmetteur(): ?string
    {
        return $this->emetteur;
    }

    public function setEmetteur(string $emetteur): static
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    public function getReceveur(): ?string
    {
        return $this->receveur;
    }

    public function setReceveur(string $receveur): static
    {
        $this->receveur = $receveur;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDatefeedback(): ?\DateTimeInterface
    {
        return $this->datefeedback;
    }

    public function setDatefeedback(\DateTimeInterface $datefeedback): static
    {
        $this->datefeedback = $datefeedback;

        return $this;
    }

    public function getEmetteurPassager(): ?Passager
    {
        return $this->emetteurPassager;
    }

    public function setEmetteurPassager(?Passager $emetteurPassager): static
    {
        $this->emetteurPassager = $emetteurPassager;

        return $this;
    }

    public function getReceveurPassager(): ?Passager
    {
        return $this->receveurPassager;
    }

    public function setReceveurPassager(?Passager $receveurPassager): static
    {
        $this->receveurPassager = $receveurPassager;

        return $this;
    }
}
