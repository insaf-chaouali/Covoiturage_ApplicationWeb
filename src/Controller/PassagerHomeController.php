<?php

namespace App\Controller;

use App\Entity\Passager;
use App\Form\PassagerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pas')]
class PassagerHomeController extends AbstractController
{
    #[Route('/new', name: 'app_passager_i', methods: ['GET', 'POST'])]
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $passager = new Passager();
        $form = $this->createForm(PassagerType::class, $passager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode le mot de passe
            $passager->setPassword($userPasswordHasher->hashPassword($passager, $passager->getPassword()));

            // Définit le rôle pour le passager
            $passager->setRoles(["ROLE_PASSAGER"]);

            // Persiste et sauvegarde l'entité
            $entityManager->persist($passager);
            $entityManager->flush();

//            return $this->render('home/index.html.twig', []);
        }

        return $this->render('pasu/new.html.twig', [
            'pasu' => $passager,
            'form' => $form,
        ]);
    }
}
