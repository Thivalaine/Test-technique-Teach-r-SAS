<?php

namespace App\DataFixtures;

use App\Entity\Statistics;
use App\Entity\Teachr;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class TeachrFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statistics = new Statistics();
        $statistics->setCount(10);
        $statistics->setDateCount(new \DateTime());
        $manager->persist($statistics);

        $finder = new Finder();
        $finder->in($this->getDir());
        $finder->name('teachrs.yaml');

        foreach ($finder as $file) {
            $fixtures = Yaml::parseFile($file->getRealPath());
            if ($fixtures) {
                foreach ($fixtures as $element) {
                    $teachr = new Teachr();
                    $teachr->setName($element['name']);
                    $element['preformation'] = "Formation";
                    $teachr->setFormation($element['formation']);
                    $element['predescription'] = "Description";
                    $teachr->setDescription($element['description']);
                    $teachr->setImage($element['image']);
                    $teachr->setDateCreation(new \DateTime());

                    $manager->persist($teachr);
                }

                file_put_contents("../mobile/components/item.json", json_encode($fixtures));
            }
        }
        $manager->flush();
    }
    public function getDir(): string
    {
        return __DIR__.'/datas';
    }
}
