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
        return $this->render('prostages/affichageEntreprises.html.twig', [
            'controller_name' => 'ProstagesController',
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
        return $this->render('prostages/affichageStages.html.twig', [
            'controller_name' => 'ProstagesController',
            'id'=>$id,
        ]);
    }
}
