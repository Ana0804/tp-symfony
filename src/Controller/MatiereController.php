<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatiereController extends AbstractController
{
    #[Route('/liste/matieres', name: 'app_matiere_liste')]
    public function index(MatiereRepository $rep): Response
    {
        $matieres = $rep -> findAll();
        return $this->render('matiere/liste.html.twig', [
            'matieres' => $matieres,
        ]);
    }

    #[Route('/ajout/matiere', name: 'app_matiere_ajout')]
    public function create(MatiereRepository $rep, Request $request) {

        $matiere = new Matiere;

        $formulaire = $this->createForm(MatiereType::class, $matiere);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $rep->add($matiere);
            return $this->redirectToRoute('app_matiere_liste');
        } else {
            return $this->render('matiere/ajout.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
}
