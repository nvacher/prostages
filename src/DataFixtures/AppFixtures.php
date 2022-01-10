<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Création des formations proposées sur prostages
        $dutInfo = new Formation();
        $dutInfo->setNomCourt("DUT Info");
        $dutInfo->setNomLong("Diplôme Universitaire Technologique Informatique");

        $dutGim = new Formation();
        $dutGim->setNomCourt("DUT Gim");
        $dutGim->setNomLong("Diplôme Universitaire Technologique Génie Industriel et Maintenance");

        $lpProgAvancee = new Formation();
        $lpProgAvancee->setNomCourt("LP PA");
        $lpProgAvancee->setNomLong("Licence Professionnelle Programmation Avancée");

        $lpMetiersNum = new Formation();
        $lpMetiersNum->setNomCourt("LP MNUM");
        $lpMetiersNum->setNomLong("Licence Professionnelle Métiers du Numérique");

        $tableauFormations = array($dutInfo, $dutGim, $lpProgAvancee, $lpMetiersNum);

        foreach($tableauFormations as $formation){
            $manager->persist($formation);
        }

        //Création des entreprises proposées sur prostages

        //Génération aléatoire du nombre d'entreprise entre 20 et 40
        $nbEntreprises = $faker->numberBetween(20, 40);

        for($i = 0; $i < $nbEntreprises; $i++){
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->company()); //Génère un nom aléatoire d'une entreprise
            $entreprise->setAdresse($faker->address()); //Génère une adresse aléatoire
            $entreprise->setActivite($faker->bs()); //Génère un texte chelou, à voir si c'est correct
            $entreprise->setSiteweb($faker->url()); //Génère une url random
            
            //Maintenant je vais venir créer un nombre aléatoire de stage pour l'entreprise que je suis entrain de créer
            $nbStages = $faker->numberBetween(1,6);

            for($j = 0; $j < $nbStages; $j++){
                $stage = new Stage();
                $stage = setTitre($faker->jobTitle());      //Génère un nom de métier aléatoire
                $stage = setDescription($faker->realTextBetween(160,299)); //Génère un texte entre 160 et 299 caractères
            }
            
        }


        $manager->flush();
    }
}
