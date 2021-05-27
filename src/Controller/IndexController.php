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
        //$date = date_create(date('Y-m-d H:i:s'));
        //echo date_format($date, 'Y-m-d H:i:s');
        $test = "teest";
        

        return $this->render('Index.html.twig', [
            'text' => $text,
            'date' => $test,
            'title' => 'Home'
        ]);
    }
}
