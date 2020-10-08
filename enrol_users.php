<?php
		/*
			Erro retornado
			"debuginfo":"Missing required key in single structure: enrolments"
        */
        include './bd/classConecta.php';

        $con = $conn;
        $bd_moodle;

		$sql = " SELECT MATRICULAUSUARIO,IDNUMBER,PERFILUSUARIO
	FROM ucsal.dbo.v_mdl_ZINTEGRACAOEAD_tudo where  IDNUMBER LIKE '%2020/1%' ";
		// $result =  sqlsrv_query($bd_totvs,"SET ANSI_NULLS ON;");
		// $result =  sqlsrv_query($bd_totvs,"SET ANSI_WARNINGS ON;"); 
		$rs_alunos_list =  sqlsrv_query($con,$sql) or die ("Erro ao trazer alunos do Totvs");


?>



<?php 

//1063

while ($rowAluno = sqlsrv_fetch_array($rs_alunos_list)) {

	$username = $rowAluno['MATRICULAUSUARIO'];
	$IDNUMBER = $rowAluno['IDNUMBER'];
	$perfil = $rowAluno['PERFILUSUARIO'];

// busca id do user
$userid_sql = "SELECT distinct id FROM mdl_user where username = '$username'";
echo "SELECT distinct id FROM mdl_user where username = '$username'";
$consulta_id_user = pg_query($bd_moodle, $userid_sql) or die ("Erro consultar alunos.");

// busca id do  course
$courseid_sql = "SELECT distinct id FROM mdl_course where IDNUMBER = '$IDNUMBER'";
$consulta_id_course = pg_query($bd_moodle, $courseid_sql) or die ("Erro consultar Cursos.");
$iduser = pg_fetch_array($consulta_id_user);
if(isset($iduser)){



//$iduser = pg_fetch_array($consulta_id_user);
//print_r($iduser);
//print_r();
$idcourse = pg_fetch_array($consulta_id_course);
echo $iduser[0];
echo $idcourse[0];

			
		/// Connection
		$token = '27152712d842005d39e570d7010d34c2';
        $domainname = 'http://localhost/html/moodle-3-8/moodle38';
		$functionname = 'enrol_manual_enrol_users';
		$restformat = 'json';
		//////// enrol_manual_enrol_users ////////
		/// Paramètres
		$enrolment = new stdClass();
		$enrolment->roleid = $perfil == 'student' ? 5 : 4; //estudante(student) -> 5; moderador(teacher) -> 4; professor(editingteacher) -> 3;
		$enrolment->userid = $iduser[0];
		$enrolment->courseid = $idcourse[0]; 
		$enrolments = array( $enrolment);
		$params = array('enrolments' => $enrolments);
		print_r($params);
		header('Content-Type: text/plain');
		$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
		require_once('./curl.php');
		$curl = new curl;
		//if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
		$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
		$resp = $curl->post($serverurl . $restformat, $params);
        print_r($resp);
        
	}

}
        
include_once('./bd/close.php');
		
?>