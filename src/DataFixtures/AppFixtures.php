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

        $produit = new Produit();

        $produit    ->setNom($this->faker->word())
                    ->setDescription($this->faker->sentence())
                    ->setStock(100)
                    ->setPrix($this->faker->randomFloat(2,1,999))
                    ->setUrlImg('IMG_09s23-2.jpg')
        ;

        $manager->persist($produit);

        $manager->flush();
    }
}
