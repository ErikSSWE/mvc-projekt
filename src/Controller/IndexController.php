<?php

// src/Controller/IndexController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function index(): Response
    {
        $text = 'Välkommen!';

        return $this->render('Index.html.twig', [
            'text' => $text,
        ]);
    }
}
