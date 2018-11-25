<?php
bouncer(isUser());
$template = new Template(TEMPLATE_PATH.'profil/index.blade.php');
$db = DB::exe("SELECT * FROM cms_user WHERE userID = :id",array('id'=>$_SESSION['id']));
if (isset($db)) {
    foreach ($db as $r) {
        $cru = [
            ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
            ['topic'=>getUserLang('breadcrumb.profil_von').$r['name']]
        ];
        $template->assign('breadcrumb',Breadcrumb::generate($cru));
        $template->assign('name',$r['name']);
        $template->assign('mail',$r['mail']);
        $template->assign('birthday',$r['birthday']);
        $template->assign('gender',getUserGender($r['userID']));
        $template->assign('origin',$r['origin']);
        $template->assign('signatur',$r['signatur']);
        $template->assign('points',$r['points']);
        $template->assign('rank',$r['rank']);
        $template->assign('language',getUserLang($r['userID']));
        $template->assign('last_on',editDateFromDB($r['last_on']).' <small><i class="far fa-clock"></i></small> '.editTimeFromDB($r['last_on']));
        $template->assign('created',editDateFromDB($r['created'])).' <small><i class="far fa-clock"></i></small> '.editTimeFromDB($r['created']);
    }
}
// sprache
$template->assign('profil.dein_profil',getUserLang('profil.dein_profil'));
include_once RESOURCE_PATH.'sidebar/index.php';
echo $template->show();