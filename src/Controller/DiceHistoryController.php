<?php

namespace App\Controller;

use App\Entity\DiceHistory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiceHistoryController extends AbstractController
{
    /**
     * @Route("/dice/history", name="dice_history")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(DiceHistory::class);
        $history = $repository->getSortedDiceField();
        return $this->render('dice_history/index.html.twig', [
            'controller_name' => 'DiceHistoryController',
            'history' => $history,
            'title' => "Historik",
        ]);
    }
}
