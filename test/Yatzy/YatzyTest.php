<?php

declare(strict_types=1);

namespace App\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/Yatzy/YatzyGame.php.
 */
class YatzyTest extends TestCase
{
    public function testConstruct2()
    {
        $_SESSION["number"] = 7;
        $_POST["action"] = "nästa";
        $controller = new YatzyGame();
        $data = $controller->getData();

        $this->assertEquals($_SESSION["message"], $data["message"]);
    }

    public function testConstruct3()
    {
        $_SESSION['dice1'] = 1;
        $_SESSION['dice2'] = 1;
        $_SESSION['dice3'] = 1;
        $_SESSION['dice4'] = 1;
        $_SESSION['dice5'] = 1;
        $_SESSION["Score1"] = 1;
        $_SESSION["number"] = 1;
        $_POST["action"] = "nästa";
        $controller = new YatzyGame();
        $data = $controller->getData();

        $this->assertEquals($_SESSION["message"], $data["message"]);
    }

    public function testConstruct1()
    {
        $_POST['dice1'] = "1";
        $_POST['dice2'] = "1";
        $_POST['dice3'] = "1";
        $_POST['dice4'] = "1";
        $_POST['dice5'] = "1";
        $_SESSION["rolls"] = 1;
        $_SESSION["number"] = 7;
        $_POST["action"] = "slå";
        $controller = new YatzyGame();
        $data = $controller->getData();

        $this->assertEquals($_SESSION["rolls"], $data["rolls"]);
    }

    public function testConstruct4()
    {
        $_SESSION["rolls"] = 3;
        $_SESSION["number"] = 7;
        $_POST["action"] = "slå";
        $controller = new YatzyGame();
        $data = $controller->getData();

        $this->assertEquals($_SESSION["rolls"], $data["rolls"]);
    }

    public function testConstructCaseStarta()
    {
        $_SESSION["rolls"] = 3;
        $_SESSION["number"] = 7;
        $_POST["action"] = "starta";
        $controller = new YatzyGame();
        $data = $controller->getData();

        $this->assertEquals($_SESSION["rolls"], $data["rolls"]);
    }
}
