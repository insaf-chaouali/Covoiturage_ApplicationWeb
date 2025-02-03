<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{


    #[Route('/acceuil', name: 'app_Accueil')]
    public function index(): Response
    {
        return $this->render('acceuil.hmtl.twig', [
            'controller_name' => 'AccueilController',
        ]);


    }
}