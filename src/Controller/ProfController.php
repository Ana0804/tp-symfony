<?php

namespace App\Controller;

use App\Repository\ProfRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfController extends AbstractController
{
    #[Route('/liste-prof', name: 'app_prof_liste')]
    public function index(ProfRepository $rep): Response
    {
        $profs = $rep -> findAll();
        return $this->render('prof/liste.html.twig', [
            'profs' => $profs,
        ]);
    }
}
