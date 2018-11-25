<?php
$template = new Template(TEMPLATE_PATH.'datenschutz/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>getUserLang('breadcrumb.datenschutz')]
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('privacy.datenschutzerklaerung',getUserLang('privacy.datenschutzerklärung'));
echo $template->show();