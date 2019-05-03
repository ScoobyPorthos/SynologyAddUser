<?php
$to = $_SERVER['argv'][1];

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($to,'[CM2P_NAS] - Your account has been created',preg_replace("#%LOGIN%#",$_SERVER['argv'][2],file_get_contents('/volume1/web/add/mail_template.html')),$headers);

?>
