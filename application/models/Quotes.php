<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Quotes extends CI_Model{

    public function getQuote()
    {
        // QOTD ( Quotes of the day )
        $quotes = array(
            "pull mostima oi jangan lupa",
            "Testing2",
            "Testing3"
        );

        return $quotes[0];
    }

}
?>