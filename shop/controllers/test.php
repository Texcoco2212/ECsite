<?php

class Calc
{

    public function __construct()
    {
        
    }

    public function sum($number1,$number2): int
    {
      $result = $number1 + $number2;
      return $result;
    }

    public function div($number1,$number2,$number3): int
    {
      $result = ($number1 / $number2) +$number3;
    return $result;
    }
  }


  $calc = new Calc();

  var_dump($calc->div(10,5,7));

  
