<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController
{
    #[Route('/liste-eleve', name: 'app_eleve_liste')]
    public function index(EleveRepository $rep): Response
    {
        $eleves = $rep -> findAll();
        return $this->render('eleve/liste.html.twig', [
            'eleves' => $eleves,
        ]);
    }
}
