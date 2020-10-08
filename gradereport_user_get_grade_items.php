<?php
  require_once('./curl.php');
$course_id=4;
$domainname = '........'; //paste your domain here
$wstoken = 'e521817f5cf9798926e0563d452b7975';//here paste your getgradetoken 
$wsfunctionname = 'gradereport_user_get_grade_items';
$restformat='xml';//REST returned values format
$grade = array( 'courseid' => $course_id , 'user_id'=> $user_id );
$user_grades = array($grade);
$params = array('user_grades' => $user_grades);

//REST CALL
header('Content-Type: text/plain');
$serverurl = $domainname . "/webservice/rest/server.php?wstoken=" . $wstoken . "&wsfunction=" . $wsfunctionname;
$curl = new curl;

//if rest format == 'xml', then we do not add the param for backwardcompatibility with Moodle < 2.2

$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
$resp = $curl->post($serverurl . $restformat, $params);
print_r($resp);

//EXCEL 
header("Content-Disposition: attachment; filename=\"gradereport.xls\"");
header("Content-Type: application/vnd.ms-excel;");
header("Pragma: no-cache");
header("Expires: 0");
$out = fopen("php://output", 'w');
foreach ($params as $data)
{
    if (is_array($data)){
        foreach ($data as $v) {

            fputcsv($out, $v,"\t");
        }
    }  
}
fclose($out);
?>