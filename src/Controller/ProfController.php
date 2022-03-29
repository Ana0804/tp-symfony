<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Form\ProfType;
use App\Repository\ProfRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfController extends AbstractController
{
    #[Route('/liste/professeurs', name: 'app_prof_liste')]
    public function index(ProfRepository $rep): Response
    {
        $profs = $rep -> findAll();
        return $this->render('prof/liste.html.twig', [
            'profs' => $profs,
        ]);
    }

    #[Route('/ajout/professeur', name: 'app_prof_ajout')]
    public function create(ProfRepository $rep, Request $request) {

        $prof = new Prof;

        $formulaire = $this->createForm(ProfType::class, $prof);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $rep->add($prof);
            return $this->redirectToRoute('app_prof_liste');
        } else {
            return $this->render('prof/ajout.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }

    #[Route('/professeur/{id}/supprimer', name: 'app_prof_suppr')]
    public function delete($id, ProfRepository $rep) {
        $prof = $rep->find($id);
        $rep->remove($prof);

        return $this->redirectToRoute('app_prof_liste');
    }
}
