<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Repository\FormationRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\StageRepository;

class ProstagesController extends AbstractController
{
    /**
     * @Route("/", name="prostages")
     */
    public function index(StageRepository $repositoryStages): Response
    {
        $stages = $repositoryStages->findAll();
        return $this->render('prostages/index.html.twig', [
            'liste_stages' => $stages,
        ]);
    }
    /**
     * @Route("/entreprises", name="pageEntreprises")
     */
    public function afficherPageEntreprises(EntrepriseRepository $repositoryEntreprise): Response
    {
        $entreprises = $repositoryEntreprise->findAll();
        return $this->render('prostages/affichageEntreprises.html.twig', [
            'controller_name' => 'ProstagesController',
            'liste_entreprises' => $entreprises,
        ]);
    }
    /**
     * @Route("/formations", name="pageFormations")
     */
    public function afficherPageFormations(FormationRepository $repositoryFormations): Response
    {
        $listeFormations = $repositoryFormations->findAll();
        return $this->render('prostages/affichageFormations.html.twig', [
            'controller_name' => 'ProstagesController',
            'listeFormations'=>$listeFormations,
        ]);
    }
    /**
     * @Route("/stages/{id}", name="pageStage")
     */
    public function afficherPageStage(Stage $stage): Response
    {
        return $this->render('prostages/affichageDescriptifStage.html.twig', [
            'controller_name' => 'ProstagesController',
            'id'=>$id,
            'stage'=>$stage,
        ]);
    }

    /**
     * @Route("/stagesParEntreprise/{id}", name="pageStagesParEntreprise")
     */
    public function afficherPageStagesParEntreprise(Entreprise $entreprise, StageRepository $repositoryStages): Response
    {
        
        $titreEntreprise = $entreprise->getNom();           //récupère le titre de l'entreprise via le repository qu'on vient de faire
        $listeStages = $repositoryStages->findBy(['entreprise'=>$entreprise->getId()]);          //récupère la liste des tuples du repositoryStages (une liste de stages) dont l'id est le même que celui passé en paramètre (id de l'entreprise sélectionnée)
        return $this->render('prostages/affichageStagesParEntreprise.html.twig', [
            'controller_name' => 'ProstagesController',
            'titreEntreprise'=>$titreEntreprise,
            'listeStages'=>$listeStages,
        ]);
    }

    /**
     * @Route("/stagesParFormation/{id}", name="pageStagesParFormation")
     */
    public function afficherPageStagesParFormation(Formation $formation): Response
    {
        $titreFormation = $formation->getNomcourt();
        $listeStages = $formation->getListeStages();
        return $this->render('prostages/affichageStagesParFormation.html.twig', [
            'controller_name' => 'ProstagesController',
            'listeStages'=>$listeStages,
            'formation'=>$titreFormation,
        ]);
    }
}
