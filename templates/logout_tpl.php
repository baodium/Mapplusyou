<?php
include ("resources/controller/all_users.php");
$new_all=$all;
if(isset($new_all['yellow'])){
unset($new_all['yellow']);
file_put_contents("resources/controller/all_users.php","<?php $"."all=".var_export($new_all,true).";");
file_put_contents("resources/js/users.js","var all=".var_export($new_all,true).";");

}


