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
        $repositoryFormations = $this->getDoctrine()->getRepository(Formation::class);
        $listeFormations = $repositoryFormations->findAll();
        return $this->render('prostages/affichageFormations.html.twig', [
            'controller_name' => 'ProstagesController',
            'listeFormations'=>$listeFormations,
        ]);
    }
    /**
     * @Route("/stages/{id}", name="pageStage")
     */
    public function afficherPageStage($id): Response
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);
        $stage = $repositoryStages->find($id);
        return $this->render('prostages/affichageDescriptifStage.html.twig', [
            'controller_name' => 'ProstagesController',
            'id'=>$id,
            'stage'=>$stage,
        ]);
    }

    /**
     * @Route("/stagesParEntreprise/{id}", name="pageStagesParEntreprise")
     */
    public function afficherPageStagesParEntreprise($id): Response
    {
        $repositoryEntreprises = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise = $repositoryEntreprises->find($id);
        $titreEntreprise = $entreprise->getNom();           //récupère le titre de l'entreprise via le repository qu'on vient de faire
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);
        $listeStages = $repositoryStages->findBy(['entreprise'=>$id]);          //récupère la liste des tuples du repositoryStages (une liste de stages) dont l'id est le même que celui passé en paramètre (id de l'entreprise sélectionnée)
        return $this->render('prostages/affichageStagesParEntreprise', [
            'controller_name' => 'ProstagesController',
            'titreEntreprise'=>$titreEntreprise,
            'listeStages'=>$listeStages,
        ]);
    }

    /**
     * @Route("/stagesParFormation/{id}", name="pageStagesParFormation")
     */
    public function afficherPageStagesParFormation($id): Response
    {
        $repositoryFormations = $this->getDoctrine()->getRepository(Formation::class);
        $formation = $repositoryFormations->find($id);
        $titreFormation = $formation->getNomcourt();
        $listeStages = $formation->getListeStages();
        return $this->render('prostages/affichageStagesParFormation.html.twig', [
            'controller_name' => 'ProstagesController',
            'listeStages'=>$listeStages,
            'formation'=>$titreFormation,
        ]);
    }
}
