<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $player1 = new Player();
        $player1->setName('Jamal Musiala');
        $player1->setSurname('Munich Wonderkid');
        $manager->persist($player1);

        $player2 = new Player();
        $player2->setName('Arjen Robben');
        $player2->setSurname('The Old Messi');
        $manager->persist($player2);

        $player3 = new Player();
        $player3->setName('Enzo Fernandez');
        $manager->persist($player3);
        $manager->flush();

        $this->addReference('player_1', $player1);
        $this->addReference('player_2', $player2);
        $this->addReference('player_3', $player3);
    }
}
