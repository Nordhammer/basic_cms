<?php
$template = new Template(TEMPLATE_PATH.'layout/wartung/footer.blade.php');
$template->assign('config.software','Nordhammer');
$template->assign('config.version','pre-alpha 2.0.0');
echo $template->show();