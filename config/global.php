<?php

/* PATH */
define('TEMPLATE_PATH','../template/views/fe/');
define('RESOURCE_PATH','../resource/views/fe/');
define('TEMPLATE_PATH_ADMIN','../template/views/admin/');
define('RESOURCE_PATH_ADMIN','../resource/views/admin/');
define('TEMPLATE_PATH_MOD','../template/views/admin/');
define('RESOURCE_PATH_MOD','../resource/views/admin/');
define('CONFIG_PATH','../config/');
define('LANGUAGE_PATH','../resource/lang/');

/* RANKS */
define('BLOCKED_RANK','gesperrt');
define('BANNED_RANK','gebannt');
define('USER_RANK','user');
define('MOD_RANK','moderator');
define('ADMIN_RANK','administrator');

/* CONFIG */
define('NATIVE_LANGUAGE','de');
include_once 'config/database.php';

/* ROUTES */
include_once 'routes/web.php';
//include_once 'routes/admin.php';
//include_once 'routes/mod.php';

/* CLASS */
include_once 'class/database.php';
include_once 'class/template.php';
include_once 'class/breadcrumb.php';
include_once 'class/pagination.php';
include_once 'class/thumbnail.php';
//include_once 'class/auth.php';

/* FUNCTION */
include_once 'function.php';
