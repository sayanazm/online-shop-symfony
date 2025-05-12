<?php

namespace App\Product\Controller;

use App\Product\Entity\Product;
use App\Product\Resource\ProductResource;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $products = $em
            ->getRepository(Product::class)
            ->findAll();

        $resources = array_map(
            static fn (Product $product) => (new ProductResource($product))->toArray(),
            $products
        );

        return $this->json($resources);
    }
}