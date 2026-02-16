<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SoutenirController extends AbstractController
{
    #[Route('/soutenir', name: 'app_soutenir')]
    public function index(): Response
    {
        return $this->render('soutenir/soutenir.html.twig', [
            'controller_name' => 'SoutenirController',
        ]);
    }
}
