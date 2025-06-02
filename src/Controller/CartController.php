<?php

namespace App\Controller;

use App\Service\Cart;
use App\Entity\Ingredients;
use App\Repository\IngredientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart): Response
    {
        return $this->render('cart/cart.html.twig', [
            'cart' => $cart->getCart()
        ]);
    }

    #[Route('/mon-panier/add/{id}', name: 'app_cart_add')]
    public function add(int $id, Cart $cart, IngredientsRepository $ingredientsRepository): Response
    {
        $ingredient = $ingredientsRepository->find($id); // Correction: méthode find() suffit ici

        if ($ingredient) {
            $cart->add($ingredient);
            $this->addFlash('success', "Produit ajouté à votre panier");
        } else {
            $this->addFlash('error', "L'ingrédient n'a pas été trouvé.");
        }

        return $this->redirectToRoute('app_cart');
    }
}
