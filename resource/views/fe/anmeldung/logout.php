<?php
session_start();
DB::exe("UPDATE cms_user SET last_on = :last_on WHERE userID = :id",array('id'=>$_SESSION['id'],'last_on'=>time()));
DB::exe("DELETE FROM cms_user_online WHERE uid = :id",array('id'=>$_SESSION['id']));
$_SESSION = array();
session_destroy();
header('Location: http://'.getConfig('DOMAIN').'/');
exit;