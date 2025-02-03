<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Form\ConducteurType;
use App\Repository\ConducteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/cond')]
class ConducteurHomeController extends AbstractController
{
    #[Route('/new', name: 'app_conducteur_i', methods: ['GET', 'POST'])]
    public function new(Request $request,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $conducteur = new Conducteur();
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);

             if ($form->isSubmitted() && $form->isValid()) {
                // $plainPassword = $form->get('plainPassword')->getData();
                 // encode the plain password
                 $conducteur->setPassword($userPasswordHasher->hashPassword($conducteur, $conducteur->getPassword()));

                $conducteur->setRoles(["ROLE_CONDUCTEUR"]);

                 $entityManager->persist($conducteur);
                 $entityManager->flush();

//           return $this->render('home/index.html.twig', []);
        }

        return $this->render('condu/new.html.twig', [
            'condu' => $conducteur,
            'form' => $form,
        ]);
    }

}