<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/liste-classe', name: 'app_classe_liste')]
    public function index(ClasseRepository $rep): Response
    {
        $classes = $rep -> findAll();
        return $this->render('classe/liste.html.twig', [
            'classes' => $classes,
        ]);
    }

    
}
