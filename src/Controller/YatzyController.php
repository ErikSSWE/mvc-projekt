<?php

// src/Controller/yatzyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Highscore;
use App\Yatzy\YatzyGame;

class YatzyController extends AbstractController
{
    /**
     * @Route("/game", name="yatzy")
     */
    public function Yatzy(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Highscore::class);
        $highscores = $repository->topTenScore();
        $game = new YatzyGame($repository);

        if ($game->checkHighScore() == true && $game->checker == true) {
            return $this->redirectToRoute('new', ['score' => $game->getHighscore()]);
        }
        return $this->render('yatzy.html.twig', $game->getData());
    }
}
