<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Service\PaypalPaymentService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(
        Request $request,
        CategoryRepository $categoryRepository,
        CartRepository $cartRepository,
        PaypalPaymentService $paymentService,
        EntityManagerInterface $entityManager
    ): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser(), 'status' => Cart::STATUS_NEW]);

        if($status = $request->query->get('status')){
            if($status === 'success'){
                $cart->setStatus(Cart::STATUS_PAYED);
                $newCart = new Cart();
                $newCart->setUser($this->getUser());

                $entityManager->persist($newCart);
                $entityManager->flush();
                $cart = $newCart;
                $this->addFlash('success', "Commande validée.");
            }
            if($status === 'error'){
                $this->addFlash('danger', "Commande en erreur. Veuillez réessayer.");
            }
        }

        return $this->render(
            'cart/cart.html.twig',
            [
                'categories' => $categoryRepository->findAll(),
                'cart' => $cart,
                'paypalUi' => $paymentService->ui($cart)
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
        if(!$this->isGranted('IS_AUTHENTICATED')){
            return $this->redirectToRoute('app_login');
        }

        $quantity = $request->query->get('quantity', 1);
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);

        if($cart === null){
            $cart = new Cart();
            $cart->setUser($this->getUser());
            $cartProduct = null;
            $entityManager->persist($cart);
        } else {
            $cartProduct = $cartProductRepository->findOneBy(['product' => $productId, 'cart' => $cart]);
        }

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

        return $this->redirectToRoute('product', ['id' => $productId]);
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
