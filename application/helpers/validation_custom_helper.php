<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('validateCPF')){

 /*
  *   Verifica se é o cpf está no FORMATO correto
  */
  function validateCPF($cpf)
  {
    $ci = get_instance();
    if(preg_match("/([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}/", $cpf))
    {
        return TRUE;
    }
    else{
        $ci->form_validation->set_message('validateCPF', 'O campo {field} está com um cpf invalido');
        return FALSE;
    }
  }
}

if ( ! function_exists('validateRG')){

  /*
  *   Verifica se é o RG está no FORMATO correto
  */
  function validateRG($rg)
  { 
    $ci = get_instance();
    if(preg_match("/([0-9]{1,2})\.([0-9]{3})\.([0-9]{3})-([\dX])/", $rg))
    {
        return TRUE;
    }
    else{
        $ci->form_validation->set_message('validateRG', 'O campo {field} está com um rg invalido');
        return FALSE;
    }

  }

}

if ( ! function_exists('validateDate')){
 /*
  *   Verifica se é uma data válida
  */
  function validateDate($date)
  {
    $ci = get_instance();
    $d = DateTime::createFromFormat('d/m/Y', $date);
    
    if($d && $d->format('d/m/Y') === $date)
    {
        return TRUE;
    }
    else{
        $ci->form_validation->set_message('validateDate', 'O campo {field} está com uma data invalida');
        return FALSE;
    }

  }
}


if ( ! function_exists('validateTime')){
 /*
  *   Verifica se é um dateTime válido
  */
 
  function validateDateTime($time)
  {
    $ci = get_instance();
     $d = DateTime::createFromFormat('d/m/Y H:i:s', $time);
    
    if($d && $d->format('d/m/Y H:i:s') === $time)
    {
        return TRUE;
    }
    else{
        $ci->form_validation->set_message('validateDate', 'O campo {field} está com uma data e tempo invalida');
        return FALSE;
    }
  }
}


if ( ! function_exists('validateTime')){
 /*
  *   Verifica se é um dateTime válido
  */
 
  function validateTime($time)
  {
    $ci = get_instance();
     $d = DateTime::createFromFormat('H:i', $time);
    
    if($d && $d->format('H:i') === $time)
    {
        return TRUE;
    }
    else{
        $ci->form_validation->set_message('validateDate', 'O campo {field} está com tempo invalido');
        return FALSE;
    }
  }
}





