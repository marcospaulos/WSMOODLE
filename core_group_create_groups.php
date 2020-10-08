<?php

 //Exibe todos os erros PHP (see changelog)
 error_reporting(E_ALL);

 include './bd/classConecta.php';
 include './samples/client.php';
 $con = $conn;



 $token = '27152712d842005d39e570d7010d34c2';
 $domainname = 'http://localhost/html/moodle-3-8/moodle38';
 $functionname = 'core_user_create_users';
 //////// moodle_user_create_users ////////
 /// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
 // REST RETURNED VALUES FORMAT
 $restformat = 'json'; //Also possible in Moodle 2.2 and later: 'json'


/// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
$group= new stdClass();

$group->courseid   = 4;//TODO - set the course id

$group->name   = 'Test group';
$group->description  = 'Test group description';
$group->idnumber  = 'testgroup-01';

//executing...
$params = array('groups' => array($group));


header('Content-Type: text/plain');
$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
require_once('./curl.php');
$curl = new curl;
//if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
$resp = $curl->post($serverurl . $restformat, $params);
print_r($resp);


?>