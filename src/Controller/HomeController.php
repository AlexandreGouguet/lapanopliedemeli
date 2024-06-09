<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $presentationCategories = $categoryRepository->findBy([], [], 5);
        $lastProducts = $productRepository->findBy([], ['createdAt' => 'DESC'], 5);
        return $this->render(
            'home/home.html.twig',
            [
                'categories' => $categoryRepository->findAll(),
                'presentation_categories' => $presentationCategories,
                'last_products' => $lastProducts
            ]
        );
    }
}
