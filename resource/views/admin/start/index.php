<?php
$template = new Template(TEMPLATE_PATH_ADMIN.'start/index.blade.php');
$cru = [
    ['path'=>'/start?page=1','title'=>'TITEL','topic'=>'Startseite'],
    ['topic'=>'error404']
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('xxx','xxx');
echo $template->show();