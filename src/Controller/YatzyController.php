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

        $game = new YatzyGame($repository, $this->getDoctrine()->getManager());

        if ($game->checker == true) {
            if ($game->checkHighScore() == true) {
                return $this->redirectToRoute('new', ['score' => $game->getHighscore()]);
            }
        }
        return $this->render('yatzy.html.twig', $game->getData());
    }
}
