<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Team;
use App\Entity\Player;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Create teams
        for ($i = 1; $i <= 20; $i++) {
            $team = new Team();
            $team->setName($faker->lastName);
            $team->setCountry($faker->country);
            $team->setMoneyBalance($faker->randomFloat(2, 100000, 10000000));

            $manager->persist($team);

            // Create players for each team
            for ($j = 1; $j <= 22; $j++) {
                $player = new Player();
                $player->setName($faker->firstName);
                $player->setSurname($faker->lastName);
                $player->setMarketValue($faker->randomFloat(2, 50000, 1000000));
                $player->setTeam($team);

                $manager->persist($player);
            }
        }

        $manager->flush();
    }
}
