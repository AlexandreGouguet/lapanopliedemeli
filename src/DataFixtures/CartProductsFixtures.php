<?php

namespace App\DataFixtures;

use App\Entity\CartProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CartProductsFixtures extends Fixture implements DependentFixtureInterface
{
    public const CART_PRODUCT_1 = 'cart_product_1';
    public const CART_PRODUCT_2 = 'cart_product_2';
    public const CART_PRODUCT_3 = 'cart_product_3';
    public const CART_PRODUCT_4 = 'cart_product_4';
    public const CART_PRODUCT_5 = 'cart_product_5';

    public function load(ObjectManager $manager): void
    {
        $cartProduct1 = new CartProduct();
        $cartProduct1->setProduct($this->getReference(ProductFixtures::PRODUCT_1));
        $cartProduct1->setQuantity(2);
        $cartProduct1->setCart($this->getReference(CartFixtures::CART_1));
        $manager->persist($cartProduct1);

        $cartProduct2 = new CartProduct();
        $cartProduct2->setProduct($this->getReference(ProductFixtures::PRODUCT_2));
        $cartProduct2->setQuantity(2);
        $cartProduct2->setCart($this->getReference(CartFixtures::CART_1));
        $manager->persist($cartProduct2);

        $cartProduct3 = new CartProduct();
        $cartProduct3->setProduct($this->getReference(ProductFixtures::PRODUCT_3));
        $cartProduct3->setQuantity(1);
        $cartProduct3->setCart($this->getReference(CartFixtures::CART_1));
        $manager->persist($cartProduct3);

        $cartProduct4 = new CartProduct();
        $cartProduct4->setProduct($this->getReference(ProductFixtures::PRODUCT_1));
        $cartProduct4->setQuantity(1);
        $cartProduct4->setCart($this->getReference(CartFixtures::CART_2));
        $manager->persist($cartProduct4);

        $cartProduct5 = new CartProduct();
        $cartProduct5->setProduct($this->getReference(ProductFixtures::PRODUCT_2));
        $cartProduct5->setQuantity(4);
        $cartProduct5->setCart($this->getReference(CartFixtures::CART_2));
        $manager->persist($cartProduct5);

        $manager->flush();

        $this->addReference(self::CART_PRODUCT_1, $cartProduct1);
        $this->addReference(self::CART_PRODUCT_2, $cartProduct2);
        $this->addReference(self::CART_PRODUCT_3, $cartProduct3);
        $this->addReference(self::CART_PRODUCT_4, $cartProduct4);
        $this->addReference(self::CART_PRODUCT_5, $cartProduct5);
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            CartFixtures::class
        ];
    }
}
