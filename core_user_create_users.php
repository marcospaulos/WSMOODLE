<?php



//Exibe todos os erros PHP (see changelog)
ini_set('MAX_EXECUTION_TIME', '-1');

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include './bd/classConecta.php';
include './client.php';
$con = $conn;
$bd_moodle;

//$ws = new criarUser;




$sql = "SELECT 'aluno' as tipo, a.matricula AS matricula, 
substring(ltrim(a.NOME+' '), 1, CHARINDEX(' ',ltrim(a.NOME+' '))) AS primeiro_nome, 
substring(ltrim(a.NOME+' '), CHARINDEX(' ',ltrim(a.NOME+' ')), 999) AS ultimo_nome,
lower(a.email) as email,
a.cidade as cidade,a.TELEFONE1 as phone1, a.TELEFONE2 as phone2,
a.curso
FROM ucsal.dbo.v_mdl_alunos a
WHERE a.matricula IS NOT null 
ORDER BY matricula";
// $result =  sqlsrv_query($bd_totvs,"SET ANSI_NULLS ON;");
// $result =  sqlsrv_query($bd_totvs,"SET ANSI_WARNINGS ON;"); 
$rs_alunos_list =  sqlsrv_query($con,$sql) or die ("Erro ao trazer alunos do Totvs/Sagu");




while ($rowAluno = sqlsrv_fetch_array($rs_alunos_list)) {
    //print_r($rowAluno);
    
    $username =$rowAluno['matricula'];
    
    $userid_sql = "SELECT distinct id FROM mdl_user where username = '$username'";
    $resultado = pg_query($bd_moodle, $userid_sql) or die ("Erro consultar alunos.");
    
    if( pg_num_rows( $resultado  ) == 0 ){
        
      
        echo $matricula = $rowAluno['matricula'];
        
        
        $primeiro_nome=utf8_decode($rowAluno['primeiro_nome']);
        
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
        
        /// SETUP - NEED TO BE CHANGED
        $token = '3fa2bb0c621489d7ce8cdf00fcde9dfc';
        $domainname = 'https://dev-ead.ucsal.br/moodle';
        $functionname = 'core_user_create_users';
        //////// moodle_user_create_users ////////
        /// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
        // REST RETURNED VALUES FORMAT
        $restformat = 'json'; //Also possible in Moodle 2.2 and later: 'json'
        //Setting it to 'json' will fail all calls on earlier Moodle version
        //////// moodle_user_create_users ////////
        /// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
        $user1 = new stdClass();
        $user1->username = $matricula;
        $user1->password = 'not cached';
        $user1->firstname = $primeiro_nome;
        $user1->lastname = $ultimo_nome;
        $user1->email = $email;
        $user1->auth = 'ldap';
        $user1->idnumber = $matricula;
        $user1->lang = 'pt_br';
        $user1->department = $curso;
        //$user1->theme = 'standard';
        $user1->timezone = '-12.5';
        $user1->mailformat = 0;
        $user1->description = 'Hello World!';
        $user1->city = $cidade;
       // $user1->country = 'br';
        //$preferencename1 = 'preference1';
       // $preferencename2 = 'preference2';
        $user1->preferences = array(
            array('type' => $preferencename1, 'value' => 'preferencevalue1'),
            array('type' => $preferencename2, 'value' => 'preferencevalue2'));
            // $user2 = new stdClass();
            // $user2->username = 'testusername2';
            // $user2->password = 'Testpassword#2';
            // $user2->firstname = 'testfirstname2';
            // $user2->lastname = 'testlastname2';
            // $user2->email = 'testemail2@moodle.com';
            // $user2->timezone = 'Pacific/Port_Moresby';
            // $users = array($user1, $user2);
            $users = array($user1);
            $params = array('users' => $users);
            /// REST CALL
            header('Content-Type: text/plain');
            $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
            require_once('./curl.php');
            $curl = new curl;
            //if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
            $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
            $resp = $curl->post($serverurl . $restformat, $params);
            print_r($resp);
            
            
    }

    echo 'Aluno já cadastrado no Moodle!'.$username.'</br>';
        
}
    
    
    

    ?>
