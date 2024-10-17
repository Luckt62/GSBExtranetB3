<?php
include '../include/class.pdogsb.inc.php';
$pdo = PdoGsb::getPdoGsb(); 
$code = $pdo->recupereCode(14);
var_dump($code);
?>
