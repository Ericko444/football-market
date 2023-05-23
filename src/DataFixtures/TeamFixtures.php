<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $team1 = new Team();
        $team1->setName('FC Bayern Munich');
        $team1->setCountry('Germany');
        $team1->setMoneyBalance(2000000.00);
        $team1->addPlayer($this->getReference('player_1'));
        $manager->persist($team1);

        $team2 = new Team();
        $team2->setName('Fiorentina');
        $team2->setCountry('Italy');
        $team2->setMoneyBalance(1500000.00);
        $team2->addPlayer($this->getReference('player_2'));
        $team2->addPlayer($this->getReference('player_3'));
        $manager->persist($team2);

        $manager->flush();
        
        // $movie = new Movie();
        // $movie -> setTitle('The Dark Night');
        // $movie -> setReleaseYear(2008);
        // $movie -> setDescription('Description of The Dark Night');
        // $movie -> setImagePath('https://cdn.pixabay.com/photo/2021/06/18/11/22/batman-6345897_960_720.jpg');
        // $movie->addActor($this->getReference('actor_1'));
        // $movie->addActor($this->getReference('actor_2'));
        // $manager->persist($movie);

        // $movie2 = new Movie();
        // $movie2 -> setTitle('Avengers: Endgame');
        // $movie2 -> setReleaseYear(2019);
        // $movie2 -> setDescription('Description of Avengers: Endgame');
        // $movie2 -> setImagePath('https://cdn.pixabay.com/photo/2020/10/28/10/02/captain-america-5692937_960_720.jpg');
        // $movie2->addActor($this->getReference('actor_3'));
        // $movie2->addActor($this->getReference('actor_4'));
        // $manager->persist($movie2);

        // $manager->flush();
    }
}
