<?php



/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);
 
/* Habilita a exibição de erros */
ini_set("display_errors", 1);

// Report simple running errors


     $servidor = "localhost";
     $porta = 5432;
     $bancoDeDados = "pgsql";
     $usuario = "marcosp_santos";
     $senha = "nuppead@1234";

     $conexao = pg_connect("host=$servidor port=$porta dbname=$bancoDeDados " +
                                     "user=$usuario password=$senha");
     if(!$conexao) {
         die("Não foi possível se conectar ao banco de dados.");
     }else{

     	echo 'OLha eu aqui!';
     }
     echo 'fora'; 
?>

