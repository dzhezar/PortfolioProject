<?php

namespace App\DataFixtures;

use App\Entity\Photoshoot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PhotoshootFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $photoshoot = new Photoshoot();

            $photoshoot
                ->setTitle($faker->sentence(4))
                ->setDescription($faker->realText(500))
                ->setPhotographer($faker->firstName)
                ->setModel($faker->firstName)
                ->setIsPosted($faker->boolean(80))
                ->setPublicationDate($faker->dateTimeThisYear->format('d-m-y'));
            $manager->persist($photoshoot);
            $this->addReference(Photoshoot::class . '_' . $i, $photoshoot);
        }
        $manager->flush();
    }
}
