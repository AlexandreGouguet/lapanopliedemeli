<?php

namespace App\Service;

use App\Entity\Cart;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CartService
{
    private EntityManagerInterface $entityManager;
    private CartRepository $cartRepository;
    public function __construct(
        EntityManagerInterface $entityManager,
        CartRepository $cartRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->cartRepository =$cartRepository;
    }

    public function payCommand(Cart $cart, UserInterface $user): Cart
    {
        $cart->setStatus(Cart::STATUS_PAYED);
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        return (new Cart())->setUser($user);
    }

    public function findCartByUser(UserInterface $user): Cart
    {
        $cart = $this->cartRepository->findOneBy(['user' => $user]);

        if($cart === null){
            $cart = new Cart();
            $cart->setUser($user);
            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        }

        return $cart;
    }

    public function emptyUserCartProduct(UserInterface $user): void
    {
        $cart = $this->findCartByUser($user);
        $cart->emptyCartProduct();
        $this->entityManager->flush();
    }
}