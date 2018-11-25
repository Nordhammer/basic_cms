<?php

// Suchformular
$phrase = '';
$tpl = new Template(TEMPLATE_PATH.'sidebar/suche.blade.php');
$tpl->assign('placeholder','Suche ...');
$phrase .= $tpl->show();
$template->assign('suche',$phrase);