<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_1 = 'category_1';
    public const CATEGORY_2 = 'category_2';
    public const CATEGORY_3 = 'category_3';
    public const CATEGORY_4 = 'category_4';
    public const CATEGORY_5 = 'category_5';

    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setName('Category 1');
        $category1->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.");
        $category1->setHomePosition(1);
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Category 2');
        $category2->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.");
        $category1->setHomePosition(2);
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Category 3');
        $category3->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.");
        $category1->setHomePosition(4);
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Category 4');
        $category4->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.");
        $category1->setHomePosition(3);
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('Category 5');
        $category5->setDescription("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.");
        $category1->setHomePosition(5);
        $manager->persist($category5);

        $manager->flush();

        $this->addReference(self::CATEGORY_1, $category1);
        $this->addReference(self::CATEGORY_2, $category2);
        $this->addReference(self::CATEGORY_3, $category3);
        $this->addReference(self::CATEGORY_4, $category4);
        $this->addReference(self::CATEGORY_5, $category5);
    }
}
