<?php
if (isset($_POST['submit'])) {
    $_SESSION['hint'] = '';
    $_SESSION['msg'] = '';
    $password = '';
    $password2 = '';
    $password = inputTrim($_POST['password']);
    $password2 = inputTrim($_POST['password2']);
    $err = false;
    if (empty($password)) $err = true;
    if (empty($password2)) $err = true;
    if ($err === true) {
        $_SESSION['hint'] = 'warning';
        $_SESSION['msg'] = 'Bitte alle Felder ausfüllen';
    }
    if ($password != $password2) {
        $err = true;
        $_SESSION['hint'] = 'warning';
        $_SESSION['msg'] = 'Das Kennwort ist nicht identisch';
    }
    if ($err === false) {
        include_once CONFIG_PATH.'password.php';
        DB::exe("UPDATE cms_user SET password = :pw,last_on = :last_on WHERE userID = :id",array('id'=>$_SESSION['reg_id'],'last_on'=>time(),'pw'=>md5($password).$salt));
        unset($_SESSION['reg_id']);
        $_SESSION['hint'] = 'success';
        $_SESSION['msg'] = 'Dein Kennwort wurde gespeichert';
        header('Location: '.$url.'/anmelden');
    }
}
$template = new Template(TEMPLATE_PATH.'registrierung/kennwort_festlegen.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>getUserLang('signup.kennwort_festlegen')]
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
// sprache
$template->assign('signup.kennwort_festlegen',getUserLang('signup.kennwort_festlegen'));
$template->assign('signup.kennwort',getUserLang('signup.kennwort'));
$template->assign('signup.kennwort_wiederholen',getUserLang('signup.kennwort_wiederholen'));
$template->assign('signup.absenden',getUserLang('signup.absenden'));
echo $template->show();
