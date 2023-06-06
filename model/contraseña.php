<?php

$claveOriginal = "12345";
$claveEncriptada = password_hash($claveOriginal, PASSWORD_BCRYPT);

var_dump($claveEncriptada);

?>