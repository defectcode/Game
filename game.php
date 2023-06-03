<?php

require_once 'player.php';

class Game
{
    protected $player1;
    protected $player2;
    protected $flips = 1;

    public function __construct(Player $player1, Player $player2){
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function flip()
    {
        return rand(0,1) ? "eagle" : "tails";
    }

    public function start()
    {
        while(true)
        {
            if($this->flip() == "eagle")
            {
                $this->player1->point($this->player2);
            }else{
                $this->player2->point($this->player1); 
            }

            if($this->player1->bankrupt() || $this->player2->bankrupt())
            {
                return $this->end();
            }
            $this->flips++;
        }

    }

    public function winner()
    {
        return $this->player1->bank() > $this->player2->bank() ? $this->player1 : $this->player2;
    }


    public function end()
    {
        echo  <<<EOT
            Game OVER!
            {$this->player1->name}: {$this->player1->coins}
            {$this->player2->name}: {$this->player2->coins}

            The winner: {$this->winner()->name}

            The number of throws {$this->flips}

        EOT;
    }

}



$game = new Game(
    new Player("Joe", 100),
    new Player("Jane", 100)
);


$game->start();