
<?php 
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
$user1->username = '00001111';
$user1->password = 'not cached';
$user1->firstname = 'Alice';
$user1->lastname = 'de Brito Sales';
$user1->email = 'alice.brito@ucsal.edu.br';
$user1->auth = 'ldap';
$user1->idnumber = '00001111';
$user1->lang = 'pt';
$user1->department = 'MESTRADO EM POLITICAS SOCIAIS E CIDADANIA';
//$user1->timezone = '-12.5';
//$user1->mailformat = 0;
//$user1->description = 'Hello World!';
//$user1->city = 'SALVADOR';
//$user1->country = 'br';
$preferencename1 = 'preference1';
$preferencename2 = 'preference2';
$user1->preferences = array(
    array('type' => $preferencename1, 'value' => 'preferencevalue1'),
    array('type' => $preferencename2, 'value' => 'preferencevalue2'));
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
$resp2 = utf8_decode($resp);
print_r( $resp2); 
