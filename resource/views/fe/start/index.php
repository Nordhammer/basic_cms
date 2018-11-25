<?php
$template = new Template(TEMPLATE_PATH.'start/index.blade.php');
$cru = [
    ['topic'=>getUserLang('breadcrumb.start')]
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
// sprache
$template->assign('start.wonach_suchst_du',getUserLang('start.wonach_suchst_du'));
echo $template->show();