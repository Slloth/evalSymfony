<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private $faker;
    public function __construct(private UserPasswordHasherInterface $hasher){
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user   ->setEmail("admin@test.com")
                ->setRoles(["ROLE_ADMIN"])
        ;
        $passwordHased = $this->hasher->hashPassword($user,$_ENV["ADMIN_PASSWORD"]);
        $user->setPassword($passwordHased);

        $manager->persist($user);

        $manager->flush();
    }
}
