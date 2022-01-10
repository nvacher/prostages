<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Repository\RepositoryFormation;
use App\Repository\RepositoryEntreprise;
use App\Repository\RepositoryStage;

class ProstagesController extends AbstractController
{
    /**
     * @Route("/", name="prostages")
     */
    public function index(): Response
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);
        $stages = $repositoryStages->findAll();
        return $this->render('prostages/index.html.twig', [
            'liste_stages' => $stages,
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
