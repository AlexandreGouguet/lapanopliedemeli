<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Service\CartProductService;
use App\Service\CartService;
use App\Service\PaypalPaymentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(
        Request $request,
        CartService $cartService,
        CategoryRepository $categoryRepository,
        PaypalPaymentService $paymentService
    ): Response
    {
        if(!$this->isGranted('IS_AUTHENTICATED')){
            return $this->redirectToRoute('app_login');
        }

        $cart = $cartService->findCartByUser($this->getUser());

        if($status = $request->query->get('status')){
            if($status === 'success'){
                $cart = $cartService->payCommand($cart, $this->getUser());
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
        CartService $cartService,
        CartProductService $cartProductService,
        int $cartProductId
    ): Response
    {
        if(!$this->isGranted('IS_AUTHENTICATED')){
            return $this->redirectToRoute('app_login');
        }

        $cart = $cartService->findCartByUser($this->getUser());
        $cartProductService->removeCartProductFromCart($cart, $cartProductId);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/add/{productId}', name: 'cart_add')]
    public function addProduct(
        Request $request,
        CartService $cartService,
        CartProductService $cartProductService,
        int $productId
    ): Response
    {
        if(!$this->isGranted('IS_AUTHENTICATED')){
            return $this->redirectToRoute('app_login');
        }

        $quantity = $request->query->get('quantity', 1);
        $cart = $cartService->findCartByUser($this->getUser());
        $cartProductService->addQuantityToCartProduct($cart, $productId, $quantity);

        return $this->redirectToRoute('product', ['id' => $productId]);
    }

    #[Route('/cart/empty', name: 'cart_empty')]
    public function empty(CartService $cartService): Response
    {
        if(!$this->isGranted('IS_AUTHENTICATED')){
            return $this->redirectToRoute('app_login');
        }

        $cartService->emptyUserCartProduct($this->getUser());

        return $this->redirectToRoute('cart');
    }
}
