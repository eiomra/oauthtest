<?php  
session_start();  
session_destroy();
$lcn = 'location:';
$backlink = 'https://id-sandbox.cashtoken.africa/account/signout';
header($lcn.$backlink); 
?>
