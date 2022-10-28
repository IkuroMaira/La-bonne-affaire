<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonces', name: 'app_list_annonces')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findNotSoldedProducts();
//        dd($products);

        return $this->render('pages/annonces/list_products.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/annonce/{id}', name: 'app_show_product')]
    public function showProduct(int $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);
        // dd($product);

        return $this->render('pages/annonces/show_product.html.twig', [
            'product' => $product,
        ]);
    }
}
