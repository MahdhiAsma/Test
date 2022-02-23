<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;
use App\Entity\Equipement;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 40; $i++) {
            $client = new Client();
            $client->setName('client-'. $i);
            $client->setAddress('address client-'. $i);

            $manager->persist($client);
         }

         for ($i = 0; $i < 40; $i++) {
            $equipement = new Equipement();
            $equipement->setName('Equipement-'. $i);
            $equipement->setPrice(100 * $i);
            $manager->persist($equipement);
         }

         $manager->flush();
    }
}
