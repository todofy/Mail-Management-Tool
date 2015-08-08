<?php
$SECURE = true;

include __DIR__ .'/libs/database.php';

database::Start();

$output = shell_exec('php C:\wamp\www\Mail-Management-Tool\receive.php');

$res = shell_exec('ps -x');
$res = explode("\n",$res);
print_r($res);

exit;
?>