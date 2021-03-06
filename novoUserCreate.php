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
        $user1->username = '000032484';
        $user1->password = 'not cached';
        $user1->firstname = 'GOLDA';
        $user1->lastname = 'MAZUR DIAS LIMA';
        $user1->email = 'golda.lima@ucsal.edu.br';
        $user1->auth = 'ldap';
        $user1->idnumber = '000032484';
        $user1->lang = 'pt_br';
        $user1->department = 'MESTRADO EM POLITICAS SOCIAIS E CIDADANIA';
        //$user1->theme = 'standard';
        $user1->timezone = '-12.5';
        $user1->mailformat = 0;
        $user1->description = 'Hello World!';
        $user1->city = 'SALVADOR';
        $user1->country = 'br';
        $preferencename1 = 'preference1';
        $preferencename2 = 'preference2';
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
            ?>
