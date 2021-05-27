<?php

declare(strict_types=1);

namespace App\Yatzy;

use App\Entity\Highscore;
use Doctrine\ORM\EntityManager;
use App\Repository\HighscoreRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

/**
 * Test cases for the functions in src/Yatzy/YatzyGame.php.
 */
class YatzyTest extends TestCase
{

    public function testConstruct2()
    {
        $session = new Session(new MockFileSessionStorage());
        $session->set("number", 7);

        $_POST["action"] = "nästa";

        $highscoreRepository = $this->createMock(HighscoreRepository::class);
        $test = $this->createMock(EntityManager::class);

        $controller = new YatzyGame($highscoreRepository, $test, $session);
        $data = $controller->getData();

        $this->assertEquals($session->get("message"), $data["message"]);
    }

    public function testConstruct3()
    {
        $session = new Session(new MockFileSessionStorage());
        $session->set("number", 7);
        $highscoreRepository = $this->createMock(HighscoreRepository::class);
        $test = $this->createMock(EntityManager::class);

        $session->set('dice1', 1);
        $session->set('dice2', 1);
        $session->set('dice3', 1);
        $session->set('dice4', 1);
        $session->set('dice5', 1);
        $session->set('Score1', 1);
        $session->set('number', 1);
        $_POST["action"] = "nästa";
        $controller = new YatzyGame($highscoreRepository, $test, $session);
        $data = $controller->getData();

        $this->assertEquals($session->get("message"), $data["message"]);
    }

    public function testConstruct1()
    {
        $session = new Session(new MockFileSessionStorage());
        $session->set("number", 7);
        $highscoreRepository = $this->createMock(HighscoreRepository::class);
        $test = $this->createMock(EntityManager::class);

        $_POST['dice1'] = "1";
        $_POST['dice2'] = "1";
        $_POST['dice3'] = "1";
        $_POST['dice4'] = "1";
        $_POST['dice5'] = "1";
        $session->set("rolls", 1);
        $session->set("number", 7);
        $_POST["action"] = "slå";
        $controller = new YatzyGame($highscoreRepository, $test, $session);
        $data = $controller->getData();

        $this->assertEquals($session->get("rolls"), $data["rolls"]);
    }

    public function testConstruct4()
    {
        $session = new Session(new MockFileSessionStorage());
        $session->set("number", 7);
        $highscoreRepository = $this->createMock(HighscoreRepository::class);
        $test = $this->createMock(EntityManager::class);

        $session->set("rolls", 3);
        $session->set("number", 7);
        $_POST["action"] = "slå";
        $controller = new YatzyGame($highscoreRepository, $test, $session);
        $data = $controller->getData();

        $this->assertEquals($session->get("rolls"), $data["rolls"]);
    }

    public function testConstructCaseStarta()
    {
        $session = new Session(new MockFileSessionStorage());
        $session->set("number", 7);
        $highscoreRepository = $this->createMock(HighscoreRepository::class);
        $test = $this->createMock(EntityManager::class);

        $session->set("rolls", 3);
        $session->set("number", 7);
        $_POST["bet"] = 1;
        $session->set("prediction", $_POST["bet"]);
        $_POST["action"] = "starta";
        $controller = new YatzyGame($highscoreRepository, $test, $session);
        $data = $controller->getData();

        $this->assertEquals($session->get("rolls"), $data["rolls"]);
    }

    public function testConstructCaseAvsluta()
    {
        $session = new Session(new MockFileSessionStorage());
        $session->set("number", 7);
        $highscoreRepository = $this->createMock(HighscoreRepository::class);
        $test = $this->createMock(EntityManager::class);

        $session->set("rolls", 3);
        $session->set("number", 7);
        $_POST["bet"] = 1;
        $session->set("prediction", $_POST["bet"]);
        $_POST["action"] = "avsluta";
        $controller = new YatzyGame($highscoreRepository, $test, $session);
        $data = $controller->getData();

        $this->assertEquals($session->get("rolls"), $data["rolls"]);
    }
}
