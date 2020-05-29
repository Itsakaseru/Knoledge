<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Motd extends CI_Model{

    public function getMotd()
    {
        $num = rand (0,29);
        // QOTD ( Quotes of the day )
        $motd = array(
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too longdon't play arknights too long",
            "don't play arknights too long",
            "don't play arknights too long",
        );

        return $motd[$num];
    }

}
?>