__psuedocode__


class YatzyGame {

    protected hand = [
        "throws" => "",
        "dices" => [
            1 => "";
        ]
    ]

    __construct()
    {
        $this->hand["throws"] = $_SESSION["rolls"];
        $this->hand["dices"][1] = $_SESSION["dice1"];
        $this->hand["dices"][2] = $_SESSION["dice2"];
        $this->hand["dices"][3] = $_SESSION["dice3"];
        $this->hand["dices"][4] = $_SESSION["dice4"];
        $this->hand["dices"][5] = $_SESSION["dice5"];

        $action = strtolower($_POST["action"] ?? "");

        switch ($action) {
            case 'nästa':
                if ($_SESSION["number"] <= 6) {
                    $this->setScore();
                    $_SESSION["rolls"] = 0;
                    $_SESSION["number"] += 1;
                } else  {
                    $_SESSION["message"] = "Spelet är nu avklarat!";
                }
                break;
            case 'slå':
                $this->continueGame();
                break;
            case 'starta':
                $this->startaGame();
                break;
        }
    }

    public function startGame()
    {   
        $_SESSION["rolls"] = 0;
        $this->currentValue = 0;
        $this->round = 0;
        $this->Score1 = 0;
        $this->Score2 = 0;
        $this->Score3 = 0;
        $this->Score4 = 0;
        $this->Score5 = 0;
        $this->Score6 = 0;
    }

    public function continueGame(){
        if ($_SESSION["rolls"] < 3) {
            $this->dices();
            $_SESSION["rolls"] += 1;
        } else {
            $_SESSION["message"] = $_SESSION["number"];
        }
    }
