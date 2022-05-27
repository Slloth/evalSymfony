<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('home/index.html.twig', [
            "produits" => $produitRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_home_show')]
    public function show(Produit $produit): Response
    {
        return $this->render('home/show.html.twig', [
            "produit" => $produit
        ]);
    }
}
