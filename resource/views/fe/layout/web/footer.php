<?php
$template = new Template(TEMPLATE_PATH.'layout/web/footer.blade.php');
$template->assign('menu.kontakt',getUserLang('menu.kontakt'));
$template->assign('menu.weiter_zu_kontakt',getUserLang('menu.weiter_zu_kontakt'));
$template->assign('menu.hilfe',getUserLang('menu.hilfe'));
$template->assign('menu.weiter_zu_hilfe',getUserLang('menu.weiter_zu_hilfe'));
$template->assign('menu.datenschutz',getUserLang('menu.datenschutz'));
$template->assign('menu.weiter_zu_datenschutz',getUserLang('menu.weiter_zu_datenschutz'));
$template->assign('menu.impressum',getUserLang('menu.impressum'));
$template->assign('menu.weiter_zu_impressum',getUserLang('menu.weiter_zu_impressum'));
$template->assign('config.software','Nordhammer');
$template->assign('config.version','pre-alpha 2.0.0');
if (isset($_SESSION['msg'])) {
    $msg = '<section id="hint" class="alert alert-'.$_SESSION['hint'].' alert-dismissible">
                <div class="container text-center">
                    <span id="text">'.$_SESSION['msg'].'</span>
                </div>
            </section>';
}
unset($_SESSION['hint']);
unset($_SESSION['msg']);
$template->assign('msg',$msg);
include_once 'useronline.php';
echo $template->show();