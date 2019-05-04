<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Responsable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

            $RH = new Departement();
            $RH->setNom('Ressources Humaines');
            $ResponsableRH= new Responsable();
            $ResponsableRH->setNom('Michel');
            $ResponsableRH->setEmail('Michel@rh.fr');
            $ResponsableRH2= new Responsable();
            $ResponsableRH2->setNom('Pierre');
            $ResponsableRH2->setEmail('Pierre@rh.fr');
            $RH->addResponsable($ResponsableRH);
            $RH->addResponsable($ResponsableRH2);
            $Com = new Departement();
            $Com->setNom('Communication');
            $ResponsableCom= new Responsable();
            $ResponsableCom->setNom('Jacques');
            $ResponsableCom->setEmail('Jacques@com.fr');
            $ResponsableCom2= new Responsable();
            $ResponsableCom2->setNom('Paul');
            $ResponsableCom2->setEmail('Paul@com.fr');
            $Com->addResponsable($ResponsableCom);
            $Com->addResponsable($ResponsableCom2);
            $Dev = new Departement();
            $Dev->setNom('Développement');
            $ResponsableDev= new Responsable();
            $ResponsableDev->setNom('Richard');
            $ResponsableDev->setEmail('Richard@dev.fr');
            $Dev->addResponsable($ResponsableDev);






            $manager->persist($RH);
            $manager->persist($Com);
            $manager->persist($Dev);
        $manager->flush();
    }
}
