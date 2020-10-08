<?php


error_reporting(E_ALL);

$dbhost   =  "10.8.1.56";   #Nome do host
$db       = "ucsal";   #Nome do banco de dados
$user     = "moodle_user"; #Nome do usuário
$password = "IoJk#$34";   #Senha do usuário


$conninfo = array('Database' => $db, 'UID' => $user, 'PWD' => $password) or die("Não foi possível a conexão com o servidor Totys !");
$conn = sqlsrv_connect($dbhost, $conninfo) or die("Não foi possível selecionar o banco de dados!");
 

