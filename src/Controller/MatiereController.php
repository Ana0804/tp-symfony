<?php

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatiereController extends AbstractController
{
    #[Route('/liste-matiere', name: 'app_matiere_liste')]
    public function index(MatiereRepository $rep): Response
    {
        $matieres = $rep -> findAll();
        return $this->render('matiere/liste.html.twig', [
            'matieres' => $matieres,
        ]);
    }
}
