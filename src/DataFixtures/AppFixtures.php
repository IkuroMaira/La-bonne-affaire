<?php

namespace App\DataFixtures;

use App\Entity\Product;
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
        for ($i=1; $i < 25; $i++) {
            $product = new Product();
            $product-> setTitle($this->faker->sentence(3))
                ->setDescription($this->faker->paragraph())
                ->setPrice($this->faker->numberBetween(0, 100));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
