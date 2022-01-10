<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProstagesController extends AbstractController
{
    /**
     * @Route("/", name="prostages")
     */
    public function index(): Response
    {
        return $this->render('prostages/index.html.twig', [
            'controller_name' => 'ProstagesController',
        ]);
    }
    /**
     * @Route("/entreprises", name="pageEntreprises")
     */
    public function afficherPageEntreprises(): Response
    {
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprises = $repositoryEntreprise->findAll();
        return $this->render('prostages/affichageEntreprises.html.twig', [
            'controller_name' => 'ProstagesController',
            'liste_entreprises' => $entreprises,
        ]);
    }
    /**
     * @Route("/formations", name="pageFormations")
     */
    public function afficherPageFormations(): Response
    {
        return $this->render('prostages/affichageFormations.html.twig', [
            'controller_name' => 'ProstagesController',
        ]);
    }
    /**
     * @Route("/stages/{id}", name="pageStages")
     */
    public function afficherPageStages($id): Response
    {
        return $this->render('prostages/affichageDescriptifStage.html.twig', [
            'controller_name' => 'ProstagesController',
            'id'=>$id,
        ]);
    }
}
