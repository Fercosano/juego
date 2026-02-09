<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(): Response
    {
    
        return $this->render('game/map.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    #[Route('/game/level/{id}', name: 'app_game_level', requirements: ['id' => '\d+'])]
    public function level(int $id): Response
    {
      
        return $this->render('game/level.html.twig', [
            'level_id' => $id,
        ]);
    }
}