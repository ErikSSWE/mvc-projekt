<?php

namespace App\Entity;

use App\Repository\DiceHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiceHistoryRepository::class)
 */
class DiceHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDice(): ?int
    {
        return $this->dice;
    }

    public function setDice(int $dice): self
    {
        $this->dice = $dice;

        return $this;
    }
}
