<?php
$template = new Template(TEMPLATE_PATH.'impressum/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>getUserLang('breadcrumb.impressum')]
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('publisher',getConfig('publisher'));
$template->assign('street',getConfig('street'));
$template->assign('code',getConfig('code'));
$template->assign('city',getConfig('city'));
$template->assign('country',getConfig('country'));
$template->assign('phone',getConfig('phone'));
$template->assign('mail',getConfig('mail'));
$template->assign('webtitle',getConfig('webtitle'));
echo $template->show();