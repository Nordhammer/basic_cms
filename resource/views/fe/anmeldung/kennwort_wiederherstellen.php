<?php
if ($_POST['submit']) {
    
    $_SESSION['hint'] = '';
    $_SESSION['msg'] = '';
    $recover = '';
    $recover = inputTrim($_POST['recover']);
    $err = false;
    if (empty($recover)) $err = true;
    if ($err === false) {
        if (checkEmail($recover)) {
            $columns = 'mail';
        } else {
            $columns = 'name';
        }
        $db = DB::exe("SELECT * FROM cms_user WHERE mail = :phrase",array('phrase'=>$recover));
        if (isset($db)) {
        
            $hash = md5(time());
            $created = time();
            DB::exe("UPDATE cms_user 
                        SET rec_hash = :hash,
                            rec_created = :created 
                      WHERE userID = :userID",array('hash'=>$hash,
                                                  'created'=>$created,
                                                  'userID'=>$r['userID']));


            
        } else {
            $_SESSION['hint'] = 'info';
            $_SESSION['msg'] = 'Nutzername oder Email-Adresse unbekannt';
        }
    }
        
}
$template = new Template(TEMPLATE_PATH.'anmeldung/kennwort_wiederherstellen.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>getUserLang('recover.kennwort_wiederherstellen')]
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('recover.kennwort_wiederherstellen',getUserLang('recover.kennwort_wiederherstellen'));
$template->assign('recover.name_mail',getUserLang('recover.name_mail'));
$template->assign('recover.mail_anfordern',getUserLang('recover.mail_anfordern'));
$template->assign('signup.btn_konto_erstellen',getUserLang('signup.btn_konto_erstellen'));
echo $template->show();