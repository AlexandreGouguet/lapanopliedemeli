<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'products')]
    public function products(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy([], ['name' => 'ASC']);
        return $this->render('products/products.html.twig', ['products' => $products]);
    }

    #[Route('/products/{id}', name: 'product')]
    public function product(ProductRepository $productRepository, int $id): Response
    {
        $product = $productRepository->findOneBy(['id' => $id]);
        return $this->render('products/product.html.twig', ['product' => $product]);
    }
}
