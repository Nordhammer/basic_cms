<?php
$template = new Template(TEMPLATE_PATH.'hilfe/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>'Hilfe']
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('error.err404',getUserLang('error.err404'));
echo $template->show();