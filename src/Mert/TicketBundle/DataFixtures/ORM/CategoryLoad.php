<?php
namespace Mert\TicketBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mert\TicketBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Technical Department');

        $manager->persist($category);
        $manager->flush();

        $category = new Category();
        $category->setName('Sales Department');

        $manager->persist($category);
        $manager->flush();

        $category = new Category();
        $category->setName('General Issues');

        $manager->persist($category);
        $manager->flush();
    }
}