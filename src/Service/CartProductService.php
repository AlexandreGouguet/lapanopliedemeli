<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class CartProductService
{
    private EntityManagerInterface $entityManager;
    private CartProductRepository $cartProductRepository;
    private ProductRepository $productRepository;
    public function __construct(
        EntityManagerInterface $entityManager,
        CartProductRepository $cartProductRepository,
        ProductRepository $productRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->cartProductRepository = $cartProductRepository;
        $this->productRepository = $productRepository;
    }

    public function addQuantityToCartProduct(Cart $cart, int $productId, int $quantity): void
    {
        $cartProduct = $this->cartProductRepository->findOneBy(['product' => $productId, 'cart' => $cart]);

        if($cartProduct === null){
            $product = $this->productRepository->findOneBy(['id' => $productId]);
            $cartProduct = new CartProduct();
            $cartProduct->setCart($cart);
            $cartProduct->setProduct($product);
            $cartProduct->setQuantity($quantity);
            $this->entityManager->persist($cartProduct);
        } else {
            $cartProduct->addQuantity($quantity);
        }

        $this->entityManager->flush();
    }

    public function removeCartProductFromCart(Cart $cart, int $cartProductId): void
    {
        $cartProduct = $this->cartProductRepository->findOneBy(['id' => $cartProductId]);
        if($cartProduct === null){
            return;
        }

        $cart->removeCartProduct($cartProduct);
        $this->entityManager->flush();
    }
}