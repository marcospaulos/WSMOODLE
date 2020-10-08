<?php 
/*Este post mostra código PHP para efetuar consulta de lista de nota de um aluno em todas as atividades de um curso   do Moodle. Isso será feito  via  webservice com linguagem PHP. 

Para usar este código, instale no Moodle o plugin restjonson, protocolo de comunicação json para webservice. 

O resultado do webservice traz vários informações detalhada de cada atividade, além da nota do aluno.*/

//url de acesso
  $remotemoodle="xxxxxxxxxxx"; //MOODLE_URL - endereço do Moodle
  $url=$remotemoodle . '/webservice/restjson/server.php';

  //parametros a ser passado ao webservice
  $param=array();
  $param['wstoken']="xxxxxx"; //token de acesso ao webservice
  $param['wsfunction']="gradereport_user_get_grade_items";
  
  //especificar usuário 
  $param['userid']=4; //especifique do usuário. Clique aqui e veja como recuperar id  do usuário. 
  $param['courseid']=67;
  
	//converter array para json
  $paramjson = json_encode($param);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $paramjson);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  $result =json_decode($result);
  
  //imprimindo resultado
  print_r($result);
  ?>