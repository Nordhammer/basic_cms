<?php
date_default_timezone_set('Europe/Berlin');
DB::exe("DELETE FROM cms_user_online WHERE created < :timer",array('timer'=>(time()-900)));
$c = DB::countName('cms_user_online','session',session_id());
if ($c > 0) {
    DB::exe("UPDATE cms_user_online SET created = :timer, uid = :id, uip = :ip WHERE session = :session",array('session'=>session_id(),'timer'=>time(),'id'=>$_SESSION['id'],'ip'=>$_SERVER['REMOTE_ADDR']));
} else {
    $c = DB::countName('cms_user_online','uip',$_SERVER['REMOTE_ADDR']);
    if ($c == 0) {
        DB::exe("INSERT INTO `cms_user_online` (`session`,`created`,`uid`,`uip`) VALUES (:session,:timer,:id,:ip)",array('session'=>session_id(),'timer'=>time(),'id'=>($_SESSION['id']) ?? 0,'ip'=>$_SERVER['REMOTE_ADDR']));
        // DB::exe("UPDATE cms_user SET last_on = :last_on WHERE userID = :id",array('id'=>$_SESSION['id'],'last_on'=>time()));
    }
}
$allUser = DB::count('cms_user_online');
$guest_user = DB::countID('cms_user_online','uid','0');
$reg_user = $allUser-$guest_user;
if ($reg_user == '1') {
    $user = getUserLang('useronline.mitglied');
} else {
    $user = getUserLang('useronline.mitglieder');
}
if ($guest_user == '1') {
    $guest = getUserLang('useronline.gast');
} else {
    $guest = getUserLang('useronline.gaeste');
}
$template->assign('footer.user_online',$allUser.' '.getUserLang('useronline.online').' ('.$reg_user.' '.$user.', '.$guest_user.' '.$guest.')');