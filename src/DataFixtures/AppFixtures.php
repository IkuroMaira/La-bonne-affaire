<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /*
     * Pour mettre en place Faker PHP
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        /**
         * Products
         */
        for ($i = 1; $i < 25; $i++) {
            $product = new Product();
            $product ->setTitle($this->faker->sentence(3))
                ->setDescription($this->faker->paragraph())
                ->setPrice($this->faker->numberBetween(0, 100))
                ->setIsSold(mt_rand(0,1) == 1 ? true : false);

            $manager->persist($product);
        }

        /**
         * Users
         */
        for ($j = 1; $j < 25; $j++) {
            $user = new User();
            $user ->setFirstname($this->faker->firstName())
                ->setLastname($this->faker->lastName())
                ->setEmail($this->faker->email())
                ->setPassword('password')
                ->setPlainPassword('password')
                ->setPseudo($this->faker->words(1, true))
                ->setRoles(['ROLE_USER'])
                ->setPhoneNumber($this->faker->phoneNumber())
                ->setAddress($this->faker->address());

            $manager->persist($user);
        }

        for($k = 0; $k < 25; $k++) {
            $comment = new Comment();
            $comment ->setContent($this->faker->sentence())
                ->setAuthorID($this->faker->numberBetween(0, 25));

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
