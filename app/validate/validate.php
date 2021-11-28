<?php

namespace app\validate;

class validate
{
  public function name($name)
  {
    if(strlen($name)<4){
      return "Name is too short";
    }
    else if(preg_match("/^\W/",$name))
    {
      return "Name can only contain letters";
    }
    else{
      return "";
    }
  }
  public function pass($pass)
  {
    if(strlen($pass)<6)
    {
      return "Password is too short.Should be at least 6 characters.";
    }
    return "";
  }
  public function email($email)
  {
      if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return "";
      }
    return "Invalid email";
  }

}