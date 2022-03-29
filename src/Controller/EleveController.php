<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController
{
    #[Route('/liste/eleves', name: 'app_eleve_liste')]
    public function index(EleveRepository $rep): Response
    {
        $eleves = $rep -> findAll();
        return $this->render('eleve/liste.html.twig', [
            'eleves' => $eleves,
        ]);
    }

    #[Route('/ajout/eleve', name: 'app_eleve_ajout')]
    public function create(EleveRepository $rep, Request $request) {

        $eleve = new Eleve;

        $formulaire = $this->createForm(EleveType::class, $eleve);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $rep->add($eleve);
            return $this->redirectToRoute('app_eleve_liste');
        } else {
            return $this->render('eleve/ajout.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }

    #[Route('/liste/{id}/details', name: 'app_eleve_details')]
    public function details($id, EleveRepository $rep)
    {
        $eleve = $rep->find($id);

        return $this->render('eleve/details.html.twig', [
            'eleve' => $eleve,
        ]);
    }


    #[Route('/eleve/{id}/supprimer', name: 'app_eleve_suppr')]
    public function delete($id, EleveRepository $rep) {
        $eleve = $rep->find($id);
        $rep->remove($eleve);

        return $this->redirectToRoute('app_eleve_liste');
    }
}
