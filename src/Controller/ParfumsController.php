<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParfumsController extends AbstractController
{
    // Route pour afficher la liste des parfums
    #[Route('/parfums', name: 'parfum_list')]
    public function list(): Response
    {
        // Liste des parfums à afficher
        $parfums = [
            ['name' => 'Patchouli', 'description' => 'Parfum intense aux notes boisées et épicées.', 'image' => '/images/patchouli.jpg'],
            ['name' => 'Jasmin', 'description' => 'Senteur florale douce et envoûtante.', 'image' => '/images/jasmin.jpg'],
            ['name' => 'Vanille', 'description' => 'Parfum gourmand aux notes sucrées et chaleureuses.', 'image' => '/images/vanille.jpg'],
            ['name' => 'Rose', 'description' => 'Arôme romantique et élégant, symbole de passion.', 'image' => '/images/rose.jpg'],
            ['name' => 'Menthe Poivrée', 'description' => 'Senteur fraîche et revigorante.', 'image' => '/images/menthe_poivree.jpg'],
            ['name' => 'Lavande', 'description' => 'Parfum relaxant aux notes herbacées et florales.', 'image' => '/images/lavande.jpg'],
        ];

        return $this->render('parfums/index.html.twig', [
            'parfums' => $parfums,
        ]);
    }

    // Route pour gérer les commandes de parfums
    #[Route('/parfums/order', name: 'parfum_order', methods: ['POST'])]
    public function order(Request $request): Response
    {
        // Récupérer les quantités des parfums
        $quantities = $request->request->all('quantity', []);

        // Optionnel : Traiter la commande ici (ex: enregistrer dans la base de données)

        // Affichage des quantités dans la vue de confirmation
        return $this->render('parfums/order_confirmation.html.twig', [
            'quantities' => $quantities,
        ]);
        
        return $this->render('parfums/index.html.twig', [
            'controller_name' => 'ParfumsController',
        ]);
    
    
    
    }



}
