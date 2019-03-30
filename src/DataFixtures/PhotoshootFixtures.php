<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Photoshoot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PhotoshootFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $category = $this->getReference(Category::class . '_' . $faker->numberBetween(0, 1));
            $photoshoot = new Photoshoot();
            $photoshoot
                ->setTitle($faker->sentence(4))
                ->setCategory($category)
                ->setDescription($faker->realText(500))
                ->setShortDescription($faker->text(70))
                ->setPhotographer($faker->firstName)
                ->setModel($faker->firstName)
                ->setIsPosted($faker->boolean(80))
                ->setPublicationDate($faker->dateTimeThisYear);

            $manager->persist($photoshoot);
            $this->addReference(Photoshoot::class . '_' . $i, $photoshoot);
        }
        $manager->flush();
    }
}
