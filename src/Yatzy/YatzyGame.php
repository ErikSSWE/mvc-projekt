<?php

declare(strict_types=1);

namespace App\Yatzy;


use App\Repository\HighscoreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class YatzyGame
{
    protected $diceHand = null;

    protected $hand = [
        "throws" => "",
        "dices" => [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ]
    ];

    var $checker = false;

    /**
     * @var HighscoreRepository
     */
    protected $highscoreRepository;

    /**
     * OneLevel Constructor
     *
     * @param HighscoreRepository $manager
     */
    public function __construct(HighscoreRepository $highscoreRepository)
    {
        $this->session = new Session();
        //$this->session->set('test', +1);
        //echo "test:::" . $this->session->get('test');

        $this->highscoreRepository = $highscoreRepository;

        $this->hand["throws"] = $this->session->get("rolls") ?? 0;
        $this->hand["dices"][1] = $this->session->get('dice1') ?? 0;
        $this->hand["dices"][2] = $this->session->get('dice2') ?? 0;
        $this->hand["dices"][3] = $this->session->get('dice3') ?? 0;
        $this->hand["dices"][4] = $this->session->get('dice4') ?? 0;
        $this->hand["dices"][5] = $this->session->get('dice5') ?? 0;

        $this->checker = false;

        $action = strtolower($_POST["action"] ?? "");

        switch ($action) {
            case 'nästa':
                if ($this->session->get("number") <= 6) {
                    $this->setScore();
                    $this->session->set("rolls", 0);
                    $this->addValueToSessionVar('number', 1);
                }
                $_SESSION["message"] = "Spelet är nu avklarat!";
                break;
            case 'slå':
                $this->continueGame();
                break;
            case 'starta':
                $this->startaGame();
                break;
            case 'avsluta':
                $this->checker = true;
                break;
        }
    }

    public function setScore()
    {
        foreach ($this->hand["dices"] as $value) {
            if ($value == $this->session->get("number")) {
                $number = $this->session->get("number");
                $this->addValueToSessionVar("Score" . $number, $value);
            }
        }
        
        $this->session->set("dice1", 0);
        $this->session->set("dice2", 0);
        $this->session->set("dice3", 0);
        $this->session->set("dice4", 0);
        $this->session->set("dice5", 0);
    }

    public function startaGame()
    {
        $this->session->set("rolls", 0);
        $this->session->set("dice1", 0);
        $this->session->set("dice2", 0);
        $this->session->set("dice3", 0);
        $this->session->set("dice4", 0);
        $this->session->set("dice5", 0);
        $this->session->set("number", 1);
        $this->session->set("Score1", 0);
        $this->session->set("Score2", 0);
        $this->session->set("Score3", 0);
        $this->session->set("Score4", 0);
        $this->session->set("Score5", 0);
        $this->session->set("Score6", 0);
    }

    public function addValueToSessionVar($name, $value)
    {
        $val = $this->session->get($name);
        $newVal = $val += $value;
        $newVal = $this->session->set($name, $newVal);
    }


    public function continueGame()
    {
        if ($this->session->get("rolls") < 3) {
            $this->dices();
            $this->addValueToSessionVar("rolls", 1);
        }
        $this->session->set("message", $this->session->get("number"));
    }


    public function dices()
    {
        if (isset($_POST['dice1']) && $_POST['dice1'] != "1") {
            $this->session->set("dice1", rand(1, 6));
        }

        if (isset($_POST['dice2']) && $_POST['dice2'] != "1") {
            $this->session->set("dice2", rand(1, 6));
        }

        if (isset($_POST['dice3']) && $_POST['dice3'] != "1") {
            $this->session->set("dice3", rand(1, 6));
        }

        if (isset($_POST['dice4']) && $_POST['dice4'] != "1") {
            $this->session->set("dice4", rand(1, 6));
        }

        if (isset($_POST['dice5']) && $_POST['dice5'] != "1") {
            $this->session->set("dice5", rand(1, 6));
        }
    }

    public function getData()
    {
        return [
            "title" => "Yatzy",
            "guide" => "För att spela klicka först starta
                , sen är det bara att klicka i dem du vill slå om
                när du är klar klickar du bara avsluta",
            "message" => $this->session->get("message"),
            "dice1" => $this->session->get("dice1")  ?? 0,
            "dice2" => $this->session->get("dice2") ?? 0,
            "dice3" => $this->session->get("dice3") ?? 0,
            "dice4" => $this->session->get("dice4") ?? 0,
            "dice5" => $this->session->get("dice5") ?? 0,
            "rolls" => $this->session->get("rolls") ?? 0,
            "Score1" => $this->session->get("Score1") ?? 0,
            "Score2" => $this->session->get("Score2") ?? 0,
            "Score3" => $this->session->get("Score3") ?? 0,
            "Score4" => $this->session->get("Score4") ?? 0,
            "Score5" => $this->session->get("Score5") ?? 0,
            "Score6" => $this->session->get("Score6") ?? 0,
        ];
    }


    public function getHighscore() 
    {
        $totalScore = $this->session->get("Score1") ?? 0;
        $totalScore += $this->session->get("Score2") ?? 0;
        $totalScore += $this->session->get("Score3") ?? 0;
        $totalScore += $this->session->get("Score4") ?? 0;
        $totalScore += $this->session->get("Score5") ?? 0;
        $totalScore += $this->session->get("Score6") ?? 0;

        return $totalScore;
    }

    public function checkHighScore()
    {
        if ($this->getHighscore() > $this->showHighscore())
        {
            return true;
        }
        return false;
    }

    public function showHighscore()
    {
        //$repository = $this->highscoreRepository->getRepository(Highscore::class);
        $highscores = $this->highscoreRepository->topTenScore();
        return $highscores[9]->getScore();
    }
}
