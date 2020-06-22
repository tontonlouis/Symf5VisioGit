<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++)
        {
            $user = (new User())
                ->setUsername("user$i")
                ->setPassword("123456");
            $manager->persist($user);
        }

        $manager->flush();
    }
}