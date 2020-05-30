<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Motd extends CI_Model{

    public function getMotd()
    {
        $num = rand (0,9);
        // QOTD ( Quotes of the day )
        $motd = array(
            "don't play arknights too long",
            "playing is fun isn't?",
            "respect everyone",
            "learning is learning",
            "don't forget your homework",
            "don't forget to eat",
            "ain't nobody got time for that",
            "welcome to your dashboard",
            "have a great day",
            "why are we still here..."
        );

        return $motd[$num];
    }

}
?>