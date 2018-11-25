<?php
$template = new Template(TEMPLATE_PATH.'error/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>'error404']
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('error.err404',getUserLang('error.err404'));
$template->assign('error.text404',getUserLang('error.text404'));
$template->assign('error.back','<a href="/start" title="'.getUserLang('error.back').' ...">'.getUserLang('error.back').'</a>');
echo $template->show();