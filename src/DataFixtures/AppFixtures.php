<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Responsable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

            $RH = new Departement();
            $RH->setNom('Ressources Humaines');
            $ResponsbleRH= new Responsable();
            $ResponsbleRH->setNom('Michel');
            $ResponsbleRH->setEmail('Michel@rh.fr');
            $ResponsbleRH2= new Responsable();
            $ResponsbleRH2->setNom('Pierre');
            $ResponsbleRH2->setEmail('Pierre@rh.fr');
            $RH->addResponsable($ResponsbleRH);
            $RH->addResponsable($ResponsbleRH2);


            $manager->persist($RH);
        $manager->flush();
    }
}
