<?php


namespace App\Tests\Repository;


use App\DataFixtures\TestFixtures;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserFixturesTest extends KernelTestCase
{

    use FixturesTrait;

    public function testCountUser()
    {
        self::bootKernel();
        $this->loadFixtures([TestFixtures::class]);
        $users = self::$container->get(UserRepository::class)->count([]);
        $this->assertEquals(10, $users);
    }
}