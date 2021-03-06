<?php
$template = new Template(TEMPLATE_PATH.'layout/web/header.blade.php');
// config
$template->assign('native_language',NATIVE_LANGUAGE);
$template->assign('config.domain',getConfig('DOMAIN'));
$template->assign('config.webtitle',getConfig('WEBTITLE'));
$template->assign('config.publisher',getConfig('PUBLISHER'));
$template->assign('config.author',getConfig('AUTHOR'));
$template->assign('config.copyright',getConfig('COPYRIGHT'));
$template->assign('config.robots',getConfig('ROBOTS'));
// sprache
$template->assign('menu.start',getUserLang('menu.start'));
$template->assign('menu.zurueck_zu_start',getUserLang('menu.zurueck_zu_start'));
// wartungsmodus
$wartung = '';
if (getConfig('WARTUNG') == 1) {
    if (isAdmin() == true) {
        $wartung = '<div class="bg-danger text-white text-center py-1 wartung">
                        <div class="container">'.getUserLang('maintenance.webseite_in_wartung').'</div>
                    </div>';
    }
}
$template->assign('wartungsmodus',$wartung);
// anmeldung
$log = '';
if (empty($_SESSION['id'])) {
    $tpl = new Template(TEMPLATE_PATH.'anmeldung/logout.blade.php');
    $tpl->assign('menu.registrieren',getUserLang('menu.registrieren'));
    $tpl->assign('menu.weiter_zu_registrieren',getUserLang('menu.weiter_zu_registrieren'));
    $tpl->assign('menu.anmelden',getUserLang('menu.anmelden'));
    $tpl->assign('menu.weiter_zu_anmelden',getUserLang('menu.weiter_zu_anmelden'));
    $log .= $tpl->show();
} else {
    $tpl = new Template(TEMPLATE_PATH.'anmeldung/login.blade.php');
    $tpl->assign('menu.dein_profil',getUserLang('menu.dein_profil'));
    $tpl->assign('menu.weiter_zu_dein_profil',getUserLang('menu.weiter_zu_dein_profil'));
    if (isAdmin() == true) {
        $wcp = '';
        $tpl2 = new Template(TEMPLATE_PATH.'anmeldung/wcp.blade.php');
        $tpl2->assign('path','/admin');
        $tpl2->assign('menu.wcp',getUserLang('menu.admin_wcp'));
        $tpl2->assign('menu.weiter_zu_wcp',getUserLang('menu.weiter_admin_wcp'));
        $wcp .= $tpl2->show();
    } else if (isMod() == true) {
        $wcp = '';
        $tpl2 = new Template(TEMPLATE_PATH.'anmeldung/wcp.blade.php');
        $tpl2->assign('path','/mod');
        $tpl2->assign('menu.wcp',getUserLang('menu.mod_wcp'));
        $tpl2->assign('menu.weiter_zu_wcp',getUserLang('menu.weiter_mod_wcp'));
        $wcp .= $tpl2->show();
    }
    $tpl->assign('menu.abmelden',getUserLang('menu.abmelden'));
    $tpl->assign('menu.weiter_zu_abmelden',getUserLang('menu.weiter_zu_abmelden'));
    $log .= $tpl->show();
}
$template->assign('log',$log);
$template->assign('wcp',$wcp);
// ausgabe
echo $template->show();