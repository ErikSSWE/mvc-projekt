<?php

// src/Controller/GameOf21Controller.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameOf21Controller extends AbstractController
{
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('GameOf21.html.twig', [
            'number' => $number,
        ]);
    }
}
