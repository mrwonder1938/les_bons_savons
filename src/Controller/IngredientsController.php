<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientsController extends AbstractController
{
    
    #[Route('/ingredients', name: 'app_ingredients')]
     
    public function listIngredients(): Response
    {
        // Liste des ingrédients avec leurs informations (id, nom, description et image)
        $ingredients = [
            ['id' => 1, 'name' => 'Moringa', 'description' => 'Le Moringa est une plante utilisée pour ses nombreuses propriétés médicinales et nutritionnelles.', 'image' => 'moringa_2025_stage.jpg'],
            ['id' => 2, 'name' => 'Charbon', 'description' => 'Le charbon actif est utilisé pour ses propriétés de détoxification et de purification.', 'image' => 'charbon.jpg'],
            ['id' => 3, 'name' => 'Curcuma', 'description' => 'Le curcuma est une épice aux vertus anti-inflammatoires, antioxydantes et digestives.', 'image' => 'curcuma.jpg'],
            ['id' => 4, 'name' => 'Miel', 'description' => 'Le miel est un édulcorant naturel avec des propriétés antibactériennes et antioxydantes.', 'image' => 'miel.jpg'],
            ['id' => 5, 'name' => 'Romarin', 'description' => 'Le romarin est une plante utilisée en cuisine et pour ses bienfaits sur la digestion et la mémoire.', 'image' => 'romarin.jpg'],
            ['id' => 6, 'name' => 'Poudre de Rose', 'description' => 'La poudre de rose est utilisée en cosmétique pour ses propriétés hydratantes et régénératrices.', 'image' => 'poudre_de_rose.jpg'],
            ['id' => 7, 'name' => 'Aloe Vera', 'description' => 'L\'Aloe Vera est une plante qui aide à hydrater et apaiser la peau.', 'image' => 'aloe_vera.jpg'],
            ['id' => 8, 'name' => 'Karité', 'description' => 'Le beurre de karité est utilisé en cosmétique pour ses propriétés nourrissantes et réparatrices.', 'image' => 'karite.jpg'],
            ['id' => 9, 'name' => 'Huile de Coco', 'description' => 'L\'huile de coco est utilisée pour ses vertus hydratantes et nourrissantes, tant pour la peau que pour les cheveux.', 'image' => 'huile_de_coco.jpg']
        ];

        return $this->render('ingredients/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }
}
