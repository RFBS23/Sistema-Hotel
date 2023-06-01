<?php
  $clave= "12345";
  $claveEncriptada = password_hash($clave, PASSWORD_BCRYPT);

  var_dump($claveEncriptada);
  
?>