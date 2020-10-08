<?php


// $conexao = mysqli_connect('localhost','moodle_user','');
// $banco = mysqli_select_db($conexao,'pessoa');
// mysqli_set_charset($conexao,'utf8');
 
// $sql = mysqli_query($conexao,"select * from tb_pessoa") or die("Erro");



$host  = '10.8.1.85';
	$user = 'moodle';
	$password = 'desenv';
	$banco = 'moodle';

	$con_string = 'host='.$host.' port=5432 dbname='.$banco.' user='.$user.' password='.$password;	
	
	$bd_moodle = pg_connect($con_string) or die("Erro ao conectar ao banco Moodle!<br>String: ".$host."<br>");

//Dados do banco
// $dbhost = “hostbanco”; #Nome do host
// $db = “nomebanco”; #Nome do banco de dados
// $user = “nomeusuario”; #Nome do usuário
// $password = “senhabase”; #Senha do usuário

$dbhost   =  "10.8.1.56";   #Nome do host
$db       = "ucsal";   #Nome do banco de dados
$user     = "moodle_user"; #Nome do usuário
$password = "IoJk#$34";   #Senha do usuário


$conninfo = array('Database' => $db, 'UID' => $user, 'PWD' => $password) or die("Não foi possível a conexão com o servidor Totys !");
$conn = sqlsrv_connect($dbhost, $conninfo) or die("Não foi possível selecionar o banco de dados!");
 




    



?>

