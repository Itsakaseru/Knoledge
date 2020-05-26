<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class SaltGenerator extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getSalt()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < 5; $i++) $result .= $characters[mt_rand(0, 61)];

        return $result;
    }

}
?>