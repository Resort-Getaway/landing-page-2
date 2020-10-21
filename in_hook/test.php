<?php
/**
 * Write data to log file.1
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
 $log = "\n------------------------\n";
 $log .= date("Y.m.d G:i:s") . "\n";
 $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
 $log .= print_r($data, 1);
 $log .= "\n------------------------\n";
 file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
 return true;
}

$defaults = array('first_name' => '', 'last_name' => '', 'phone' => '', 'email' => '');

if (array_key_exists('saved', $_REQUEST)) {
 $defaults = $_REQUEST;
 writeToLog($_REQUEST, 'webform');

 $queryUrl = 'https://buenocrm.com/rest/2373/5y6ru3z8b5yvb8ug/crm.lead.add.json';
 $queryData = http_build_query(array(
 'fields' => array(
 "TITLE" => $_REQUEST['first_name'].' '.$_REQUEST['last_name'],
 "NAME" => $_REQUEST['first_name'],
 "LAST_NAME" => $_REQUEST['last_name'],
 "STATUS_ID" => "NEW",
 "OPENED" => "Y",
 "ASSIGNED_BY_ID" => 1,
 "PHONE" => array(array("VALUE" => $_REQUEST['phone'], "VALUE_TYPE" => "WORK" )),
 "EMAIL" => array(array("VALUE" => $_REQUEST['email'], "VALUE_TYPE" => "WORK" )),
 ),
 'params' => array("REGISTER_SONET_EVENT" => "Y")
 ));

 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_POST => 1,
 CURLOPT_HEADER => 0,
 CURLOPT_RETURNTRANSFER => 1,
 CURLOPT_URL => $queryUrl,
 CURLOPT_POSTFIELDS => $queryData,
 ));

 $result = curl_exec($curl);
 curl_close($curl);

 $result = json_decode($result, 1);
 writeToLog($result, 'webform result');

 if (array_key_exists('error', $result)) echo "Error saving lead: ".$result['error_description']."<br/>";
}

?>
<form rm method="post" action="">
    Name: <input type="text" name="first_name" size="15" value="<?=$defaults['first_name']?>"><br/>
    Last name: <input type="text" name="last_name" size="15" value="<?=$defaults['last_name']?>"><br/>
    Phone: <input type="phone" name="phone" value="<?=$defaults['phone']?>"><br/>
    E-mail: <input type="email" name="email" value="<?=$defaults['email']?>"><br/>
    <input type="hidden" name="saved" value="yes">
    <input type="submit" value="send">
</form>