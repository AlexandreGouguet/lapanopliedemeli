<?php

namespace App\Controller;

use App\Entity\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(CategoryRepository $categoryRepository, CartRepository $cartRepository): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
        return $this->render(
            'cart/cart.html.twig',
            [
                'categories' => $categoryRepository->findAll(),
                'cart' => $cart
            ]
        );
    }

    #[Route('/cart/remove/{cartProductId}', name: 'cart_remove')]
    public function removeProduct(
        CartRepository $cartRepository,
        CartProductRepository $cartProductRepository,
        EntityManagerInterface $entityManager,
        int $cartProductId
    ): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
        $cartProduct = $cartProductRepository->findOneBy(['id' => $cartProductId]);
        $cart->removeCartProduct($cartProduct);

        $entityManager->flush();

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/add/{productId}', name: 'cart_add')]
    public function addProduct(
        Request $request,
        CartRepository $cartRepository,
        CartProductRepository $cartProductRepository,
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager,
        int $productId
    ): Response
    {
        $quantity = $request->query->get('quantity', 1);
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
        $cartProduct = $cartProductRepository->findOneBy(['product' => $productId, 'cart' => $cart]);
        if($cartProduct !== null){
            $cartProduct->setQuantity($cartProduct->getQuantity() + $quantity);
        } else {
            $product = $productRepository->findOneBy(['id' => $productId]);

            $cartProduct = new CartProduct();
            $cartProduct->setCart($cart);
            $cartProduct->setProduct($product);
            $cartProduct->setQuantity($quantity);
            $entityManager->persist($cartProduct);
        }

        $entityManager->flush();

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/empty', name: 'cart_empty')]
    public function empty(CartRepository $cartRepository, EntityManagerInterface $entityManager): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
        $cart->emptyCartProduct();

        $entityManager->flush();

        return $this->redirectToRoute('cart');
    }
}
