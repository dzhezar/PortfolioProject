<?php


namespace App\DataFixtures;


use App\Entity\Photoshoot;
use App\Entity\PhotoshootImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PhotoshootImageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 200; $i++) {
            $image = new PhotoshootImage();
            $photoshoot = $this->getReference(Photoshoot::class . '_' . $faker->numberBetween(0, 29));


            $image
                ->setImage($faker->imageUrl(1920,1080,'fashion'))
                ->setPhotoshoot($photoshoot);
            $manager->persist($image);
        }
        $manager->flush();
    }
}