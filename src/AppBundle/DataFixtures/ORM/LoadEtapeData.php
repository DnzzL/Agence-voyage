<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Etape;

class LoadEtapeData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$circuit=$this->getReference('andalousie-circuit');
		
		$etape = new Etape();
		$etape->setNumeroEtape(1);
		$etape->setVilleEtape("Grenade");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(2);
		$etape->setVilleEtape("Cordoue");
		$etape->setNombreJours(2);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(3);
		$etape->setVilleEtape("Séville");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);

		$circuit=$this->getReference('vietnam-circuit');
		
		$etape = new Etape();
		$etape->setNumeroEtape(1);
		$etape->setVilleEtape("Hanoï");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		
		$etape = new Etape();
		$etape->setNumeroEtape(3);
		$etape->setVilleEtape("Hôi An");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(4);
		$etape->setVilleEtape("Hô Chi Minh");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(2);
		$etape->setVilleEtape("Dà Nang");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$circuit=$this->getReference('idf-circuit');
		
		$etape = new Etape();
		$etape->setNumeroEtape(1);
		$etape->setVilleEtape("Versailles");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(2);
		$etape->setVilleEtape("Paris");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$circuit=$this->getReference('italie-circuit');
		
		$etape = new Etape();
		$etape->setNumeroEtape(1);
		$etape->setVilleEtape("Florence");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(2);
		$etape->setVilleEtape("Sienne");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(3);
		$etape->setVilleEtape("Pise");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$etape = new Etape();
		$etape->setNumeroEtape(4);
		$etape->setVilleEtape("Rome");
		$etape->setNombreJours(1);
		$circuit->addEtape($etape);
		$manager->persist($etape);
		
		$manager->flush();
	}

	public function getOrder()
	{
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 3;
	}
}

// (1, 1, 'Grenade', 1),
// (1, 2, 'Cordoue', 2),
// (1, 3, 'Séville', 1),
// (2, 1, 'Hanoï', 1),
// (2, 2, 'Dà Nang', 1),
// (2, 3, 'Hôi An', 1),
// (2, 4, 'Hô Chi Minh', 2),
// (3, 1, 'Versailles', 1),
// (3, 2, 'Paris', 1),
// (4, 1, 'Florence', 2),
// (4, 2, 'Sienne', 1),
// (4, 3, 'Pise', 1),
// (4, 4, 'Rome', 2);