<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'products')]
    public function products(Request $request, ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $categoryId = $request->query->get('categoryId');
        if($categoryId !== null){
            $products = $productRepository->findBy(['category' => $categoryId], ['name' => 'ASC']);
        } else {
            $products = $productRepository->findBy([], ['name' => 'ASC']);
        }
        return $this->render('products/products.html.twig', [
            'products' => $products,
            'category' => $categoryId ? $categoryRepository->find($categoryId) : null,
            'categories' => $categoryRepository->findAll()
        ]);
    }

    #[Route('/products/{id}', name: 'product')]
    public function product(ProductRepository $productRepository, CategoryRepository $categoryRepository, int $id): Response
    {
        $product = $productRepository->findOneBy(['id' => $id]);
        return $this->render('products/product.html.twig', [
            'product' => $product,
            'categories' => $categoryRepository->findAll()
        ]);
    }
}
