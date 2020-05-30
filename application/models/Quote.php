<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Quote extends CI_Model{

    public function getQuote()
    {
        $num = rand (0,4);
        // QOTD ( Quotes of the day )
        $quotes = array(
            "Practice makes us right,</br> repetitions make us perfect.",
            "Give a man a program,</br> frustrate him for a day.</br> Teach a man to program,</br> frustrate him for a lifetime.",
            "Testing3",
            "Testing4",
            "Testing5"
        );

        return $quotes[$num];
    }

}
?>