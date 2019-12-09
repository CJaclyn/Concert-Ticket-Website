<?php
//function to make sure input can only have letters, numbers, spaces, periods, single quotes, and or hyphens
function regexCheck($arg){
  if(preg_match("/[^A-Za-z0-9-.\s\']/", $arg)){
    return false;
  }else {
    return true;
  }
}

//function to make sure username input can only have letters, numbers, and or underscores
function usernameRegex($arg){
  if(preg_match("/[^A-Za-z0-9_]/", $arg)){
    return false;
  }else {
    return true;
  }
}

//function to make sure first and last name input can only have letters, hyphens, spaces, and or periods
function nameRegex($arg){
  if(preg_match("/[^A-Za-z-.\s]/", $arg)){
    return false;
  }else {
    return true;
  }
}

?>
