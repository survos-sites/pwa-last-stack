<?php

namespace App\DataFixtures;

use App\Entity\Planet;
use App\Factory\PlanetFactory;
use App\Factory\VoyageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // https://raw.githubusercontent.com/Lazzaro83/Solar-System/master/planets.json

        $planets = [];
        $planetJson = json_decode(file_get_contents(__DIR__ . '/./planets.json'));
        foreach ($planetJson as $data) {
            // store them in /assets/images
            $imageDir = __DIR__ . '/../../assets/images/';
            $url = $data->image;
            $imageName = pathinfo($url, PATHINFO_BASENAME);
            if (!file_exists($imagePath = $imageDir . $imageName)) {
                file_put_contents($imagePath, file_get_contents($url));
            }
            $planet = new Planet();
            $planet->setName($data->name)
                ->setId($data->position)
                ->setDescription($data->description)
                ->setLightYearsFromEarth($data->distance)
                ->setImageFilename($imageName)
                ;
            $manager->persist($planet);
            if ($planet->getName() <> 'Earth') {
                $planets[] = $planet;
            }
        }
        $manager->flush();
//        PlanetFactory::createMany(5);
//        PlanetFactory::createMany(2, function() {
//            $names = PlanetFactory::OTHER_PLANET_NAMES;
//
//            return [
//                'isInMilkyWay' => false,
//                'name' => $names[array_rand($names)]
//            ];
//        });

        $purposes = [
            'occupy',
            'bring democracy',
            'setup the first Starbucks',
            'build hotels',
            'do air quality studies',
            'do agricultural research',
            'recruit workers',
            'discard nuclear waste'
        ];
        VoyageFactory::createMany(60, function () use ($planets, $purposes) {
            $planet = $planets[array_rand($planets)];
            return [
                'planet' => $planet,
                'purpose' => sprintf("Visit to %s to %s", $planet->getName(),
                    $purposes[array_rand($purposes)])

            ];
        });

        $manager->flush();
    }
}
