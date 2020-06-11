<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $password;

    public function __construct(UserPasswordEncoderInterface $password)
    {
        $this->password = $password;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i = 0; $i <= 50; $i++) {
            $property = new Property();
            $property
                ->setName($faker->name())
                ->setDescription($faker->text(200))
                ->setSurface($faker->numberBetween(80, 300))
                ->setRoom($faker->numberBetween(1,5))
                ->setFloor($faker->numberBetween(0,5))
                ->setPrice($faker->numberBetween(80000, 950000))
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setPostalCode($faker->postcode());

            $manager->persist($property);
        }

        $user = new User();
        $user->setUsername('demo')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->password->encodePassword($user, 'demo'));

        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('user')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->password->encodePassword($user2, 'user'));
        $manager->persist($user2);

        $manager->flush();
    }
}
