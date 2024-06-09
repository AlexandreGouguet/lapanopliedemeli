<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CartFixtures extends Fixture implements DependentFixtureInterface
{
    public const CART_1 = 'cart_1';
    public const CART_2 = 'cart_2';

    public function load(ObjectManager $manager): void
    {
        $cart1 = new Cart();
        $cart1->setUser($this->getReference(UserFixtures::USER_1));
        $manager->persist($cart1);

        $cart2 = new Cart();
        $cart2->setUser($this->getReference(UserFixtures::USER_2));
        $manager->persist($cart2);

        $manager->flush();

        $this->addReference(self::CART_1, $cart1);
        $this->addReference(self::CART_2, $cart2);
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
