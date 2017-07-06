<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Circuit;

class LoadCircuitData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{		
		$circuit = new Circuit();
		$circuit->setDescription('Andalousie');
		$circuit->setPaysDepart('Espagne');
		$circuit->setVilleDepart('Grenade');
		$circuit->setVilleArrivee('Séville');
		//$circuit->setDureeCircuit(4);
		$manager->persist($circuit);
		
		$this->addReference('andalousie-circuit', $circuit);
		
		$circuit = new Circuit();
		$circuit->setDescription('Vietnam');
		$circuit->setPaysDepart('VietNam');
		$circuit->setVilleDepart('Hanoi');
		$circuit->setVilleArrivee('Hô Chi Minh');
		//$circuit->setDureeCircuit(4);
		$manager->persist($circuit);
		
		$this->addReference('vietnam-circuit', $circuit);
		
		$circuit = new Circuit();
		$circuit->setDescription('Ile de France');
		$circuit->setPaysDepart('France');
		$circuit->setVilleDepart('Paris');
		$circuit->setVilleArrivee('Paris');
		//$circuit->setDureeCircuit(2);
		$manager->persist($circuit);
		
		$this->addReference('idf-circuit', $circuit);
		
		$circuit = new Circuit();
		$circuit->setDescription('Italie');
		$circuit->setPaysDepart('Italie');
		$circuit->setVilleDepart('Milan');
		$circuit->setVilleArrivee('Rome');
		//$circuit->setDureeCircuit(4);
		$manager->persist($circuit);
		
		$this->addReference('italie-circuit', $circuit);
		
		$manager->flush();
	}
	
	public function getOrder()
	{
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 1;
	}
}
// (1, 'Andalousie', 'Espagne', 'Grenade', 'Séville', 4),
// (2, 'VietNam', 'VietNam', 'Hanoi', 'Hô Chi Minh', 4),
// (3, 'Ile de France', 'France', 'Paris', 'Paris', 2),
// (4, 'Italie', 'Italie', 'Milan', 'Rome', 4);