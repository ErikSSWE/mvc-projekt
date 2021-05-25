<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Highscore;
use App\Form\Type\HighscoreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class HighscoreController extends AbstractController
{
    /**
     * @Route("/highscore", name="highscore")
     */
    public function index(): Response
    {
        //$this->createHighscore();
        $repository = $this->getDoctrine()->getRepository(Highscore::class);
        $highscores = $repository->topTenScore();


        return $this->render('highscore/index.html.twig', [
            'controller_name' => 'HighscoreController',
            'highscores' => $highscores,
        ]);
    }

    public function createHighscore(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $book = new Highscore();
        $book->setName('test10');
        $book->setScore(10);
        $date = date_create(date('Y-m-d H:i:s'));
        date_format($date, 'Y-m-d H:i:s');
        $book->setDate($date);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$book->getId());
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $highscore = new Highscore();
        $highscore->setScore($_GET["score"]);
        $date = date_create(date('Y-m-d H:i:s'));
        date_format($date, 'Y-m-d H:i:s');
        $highscore->setDate($date);

        $form = $this->createFormBuilder($highscore)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Add Highscore'])
            ->getForm();

        $form = $this->createForm(HighscoreType::class, $highscore);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            //var_dump("var_dump:::" , $form);
            //var_dump($task);
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('highscore');
        }

        return $this->render('highscore/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
