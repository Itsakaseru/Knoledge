<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Motd extends CI_Model{

    public function getMotd()
    {
        $num = rand (0,29);
        // QOTD ( Quotes of the day )
        $motd = array(
            "don't play arknights too long",
            "hehe boii",
            "Testing3",
            "Testing4",
            "Testing5",
            "Testing6",
            "Testing7",
            "Testing8",
            "Testing9",
            "Testing10",
            "Testing11",
            "Testing12",
            "Testing13",
            "Testing14",
            "Testing15",
            "Testing16",
            "Testing17",
            "Testing18",
            "Testing19",
            "Testing20",
            "Testing21",
            "Testing22",
            "Testing23",
            "Testing24",
            "Testing25",
            "Testing26",
            "Testing27",
            "Testing28",
            "Testing29",
            "Testing30",
        );

        return $motd[$num];
    }

}
?>