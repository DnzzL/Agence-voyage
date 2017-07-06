<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ProgrammationCircuit;

class LoadProgrammationCircuitData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$progcircuit = new ProgrammationCircuit();
		$progcircuit->setDateDepart(new \DateTime('2016-07-10'));
		$progcircuit->setNombrePersonnes(10);
		$progcircuit->setPrix(850);
		$progcircuit->setCircuit($this->getReference('andalousie-circuit'));
		
		$manager->persist($progcircuit);

		$this->addReference('programmation-andalousie-1', $progcircuit);
		
		$progcircuit = new ProgrammationCircuit();
		$progcircuit->setDateDepart(new \DateTime('2016-08-10'));
		$progcircuit->setNombrePersonnes(10);
		$progcircuit->setPrix(1500);
		$progcircuit->setCircuit($this->getReference('vietnam-circuit'));
		
		$manager->persist($progcircuit);
		
		$this->addReference('programmation-vietnam-1', $progcircuit);
		
		$progcircuit = new ProgrammationCircuit();
		$progcircuit->setDateDepart(new \DateTime('2016-05-15'));
		$progcircuit->setNombrePersonnes(12);
		$progcircuit->setPrix(120);
		$progcircuit->setCircuit($this->getReference('idf-circuit'));
		
		$manager->persist($progcircuit);
		
		$this->addReference('programmation-idf-1', $progcircuit);
		
		$progcircuit = new ProgrammationCircuit();
		$progcircuit->setDateDepart(new \DateTime('2016-10-23'));
		$progcircuit->setNombrePersonnes(15);
		$progcircuit->setPrix(1100);
		$progcircuit->setCircuit($this->getReference('italie-circuit'));
		
		$manager->persist($progcircuit);
		
		$this->addReference('programmation-italie-1', $progcircuit);
		
		$manager->flush();
	}

	public function getOrder()
	{
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 2;
	}
}

// (1, 1, '2016-07-10', 10, 850),
// (2, 2, '2016-08-10', 10, 1500),
// (3, 3, '2016-05-15', 12, 120),
// (4, 4, '2016-10-23', 15, 1100);
