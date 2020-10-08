<!doctype html>
<html lang="en">
  <head>
    <title>Meu webserveci </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

<?php


 //Exibe todos os erros PHP (see changelog)
error_reporting(E_ALL);

include './bd/classConecta.php';
include 'client.php';
$con = $conn;

$ws = new criarUser;


$sql = "SELECT 'aluno' as tipo, a.matricula AS matricula, 
			substring(ltrim(a.NOME+' '), 1, CHARINDEX(' ',ltrim(a.NOME+' '))) AS primeiro_nome, 
			substring(ltrim(a.NOME+' '), CHARINDEX(' ',ltrim(a.NOME+' ')), 999) AS ultimo_nome,
			lower(a.email) as email,
			a.cidade as cidade,a.TELEFONE1 as phone1, a.TELEFONE2 as phone2,
			a.curso
			FROM ucsal.dbo.v_mdl_alunos a
			WHERE a.matricula IS NOT null and a.matricula in ('000032484','000889113')
			ORDER BY matricula";
            // $result =  sqlsrv_query($bd_totvs,"SET ANSI_NULLS ON;");
            // $result =  sqlsrv_query($bd_totvs,"SET ANSI_WARNINGS ON;"); 
            $rs_alunos_list =  sqlsrv_query($con,$sql) or die ("Erro ao trazer alunos do Totvs/Sagu");


?>



<h1> WEB SERVECE MOODLE </h1>

 <div class="container">
 <?php 



 while ($rowAluno = sqlsrv_fetch_array($rs_alunos_list)) {
  //print_r($rowAluno);

  echo $matricula = $rowAluno['matricula'];

 $primeiro_nome=utf8_encode($rowAluno['primeiro_nome']);

 $ultimo_nome=utf8_decode($rowAluno['ultimo_nome']);

  $email=utf8_decode($rowAluno['email']);

 $cidade=utf8_encode($rowAluno['cidade']);
 
  $str = utf8_encode($rowAluno['curso']); 
 
// assume $str esteja em UTF-8
$map = array(
    'á' => 'a',
    'à' => 'a',
    'ã' => 'a',
    'â' => 'a',
    'é' => 'e',
    'ê' => 'e',
    'í' => 'i',
    'ó' => 'o',
    'ô' => 'o',
    'õ' => 'o',
    'ú' => 'u',
    'ü' => 'u',
    'ç' => 'c',
    'Á' => 'A',
    'À' => 'A',
    'Ã' => 'A',
    'Â' => 'A',
    'É' => 'E',
    'Ê' => 'E',
    'Í' => 'I',
    'Ó' => 'O',
    'Ô' => 'O',
    'Õ' => 'O',
    'Ú' => 'U',
    'Ü' => 'U',
    'Ç' => 'C'
);
 
 $Ncurso = strtr($str, $map);

/// FIM 

 $curso= utf8_encode($Ncurso);


 $reste = $ws->userCriar($matricula,$primeiro_nome,$ultimo_nome,$email,$cidade,$curso );

print_r ($reste);



 



 }
 //echo  $reste;

?>

</div>


<?php 

include_once('./bd/close.php');
?> 
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


