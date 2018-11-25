<?php
$_SESSION['hint'] = '';
$_SESSION['msg'] = '';
$err = true;
$db = DB::exe("SELECT * FROM tmp_user WHERE hash = :hash",array('hash'=>$params[1]));
if (isset($db)) {
    foreach ($db as $r) {
        $insertID = DB::exe("INSERT INTO `cms_user` (`userID`,`name`,`mail`,`rank`,`language`,`created`,`userIP`) 
                    VALUES (:userID,:name,:mail,:rank,:language,:created,:userIP)",array('userID'=>NULL,'name'=>$r['name'],'mail'=>$r['mail'],'rank'=>'user','language'=>'de','created'=>time(),'userIP'=>$_SERVER['REMOTE_ADDR']));
        DB::exe("DELETE FROM tmp_user WHERE hash = :hash",array('hash'=>$params[1]));
        $_SESSION['reg_id'] = DB::lastInsertID($insertID);
        $err = false;
    }
}
if ($err === false) {
    $_SESSION['hint'] = 'success';
    $_SESSION['msg'] = 'Dein Konto ist nun freigeschaltet';
    header('Location: '.$url.'/kennwort-festlegen');
} else if ($err === true) {
    $_SESSION['hint'] = 'danger';
    $_SESSION['msg'] = 'Es ist ein Fehler aufgetreten. Versuche es später noch einmal.';
    header('Location: '.$url.'/');
}
echo $template->show();