<?php 
if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed'); 
}

class Mathlibrary {

    /** 
    * This is using an outside class I found on phpclasses.org evalMath
    * I just wanted to include this so I am using an outside class
    **/
    public function runString($string) 
    {
        include_once('evalmath.php');
        $m = new EvalMath;
        $m->suppress_errors = true;
        $returnVar = $m->evaluate($string);
        if ($m->last_error) {
            throw new Exception($m->last_error);
        }

        return $returnVar;
    }

    /**
     * Below are the very basic add, subtract, multiple and divid functions
     **/
    public function add($number1, $number2) 
    {
        if (is_int($number1) && is_int($number2)) {
                return $number1+$number2;
        } else {
                throw new Exception('Entered values are not numbers');
        }
    }

    public function subtract($number1, $number2)
    {
        if (is_int($number1) && is_int($number2)) {
            return $number1-$number2;
        } else {
            throw new Exception('Entered values are not numbers');
        }   
    }

    public function multiply($number1, $number2)
    {
        if (is_int($number1) && is_int($number2)) {
            return $number1*$number2;
        } else {
            throw new Exception('Entered values are not numbers');
        }   
    }

    public function divid($number1, $number2)
    {
        if (is_int($number1) && is_int($number2)) {
            return $number1/$number2;
        } else {
            throw new Exception('Entered values are not numbers');
        }   
    }
}