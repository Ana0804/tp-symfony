<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/ajout-classe', name: 'app_classe_ajout')]
    public function create(ClasseRepository $rep, Request $request) {

        $classe = new Classe;

        $formulaire = $this->createForm(ClasseType::class, $classe);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $rep->add($classe);
            return $this->redirectToRoute('app_classe_liste');
        } else {
            return $this->render('classe/ajout.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
}
