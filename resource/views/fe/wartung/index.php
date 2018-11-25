<?php
if (isset($_POST['submit'])) {
    $_SESSION['hint'] = '';
    $_SESSION['msg'] = '';
    $name = '';
    $password = '';
    $name = inputTrim($_POST['name']);
    $password = inputTrim($_POST['password']);
    $err = false;
    if (empty($name)) $err = true;
    if (empty($password)) $err = true;
    if ($err === true) {
        $_SESSION['hint'] = 'warning';
        $_SESSION['msg'] = 'Benutzername oder Kennwort unbekannt';
    }
    if ($err === false) {
        $db = DB::exe("SELECT userID,name,password,rank,language,last_on FROM cms_user WHERE name = '".$name."'");
        if (isset($db)) {
            include_once CONFIG_PATH.'password.php';
            $user = false;
            foreach ($db as $r) {
                if ($r['rank'] == ADMIN_RANK) {
                    if (preg_match("/$salt/",$r['password'])) {
                        if ((md5($password).$salt) == $r['password']) {
                            $user = true;
                        }
                    } else {
                        if (md5($password) == $r['password']) {
                            $user = true;
                        }
                    }
                    if ($user === true) {
                        $_SESSION['id'] = $r['userID'];
                        $_SESSION['lang'] = $r['language'];
                        $_SESSION['group'] = $r['rank'];
                        /*
                        DB::exe("UPDATE cms_user SET last_on = :last_on WHERE userID = :id",array('id'=>$r['userID'],'last_on'=>time()));
                        DB::exe("DELETE FROM cms_user_online WHERE created < :created",array('created'=>(time()-900)));
                        DB::exe("INSERT INTO `cms_user_online` (`id`,`session`,`userID`,`userIP`,`created`) VALUES (NULL,:session,:userID,:userIP,:created)",array('session'=>session_id(),'userID'=>$r['userID'],'userIP'=>$_SERVER['REMOTE_ADDR'],'created'=>time()));
                        */
                        $_SESSION['hint'] = 'success';
                        $_SESSION['msg'] = 'Willkommen zurück <strong>'.$r['name'].'</strong>!';
                        header('Location: http://'.getConfig('DOMAIN').'/');
                    }
                }
            }
        }
    }
}
$template = new Template(TEMPLATE_PATH.'wartung/index.blade.php');
/*
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>'Wartungsmodus']
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
*/
$template->assign('login.anmelden',getUserLang('login.anmelden'));
$template->assign('login.name',getUserLang('login.name'));
$template->assign('login.kennwort',getUserLang('login.kennwort'));
$template->assign('maintenance.h1',getUserLang('maintenance.h1'));
$template->assign('maintenance.hinweis',getUserLang('maintenance.hinweis'));
echo $template->show();