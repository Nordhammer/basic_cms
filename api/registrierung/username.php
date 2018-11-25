<?php
include_once 'config/database.php';
include_once 'class/database.php';
DB::connect($_CONF['db']['host'],$_CONF['db']['user'],$_CONF['db']['pw'],$_CONF['db']['name']);
$str = htmlspecialchars($_GET['q'],ENT_QUOTES, "UTF-8");
$c = DB::countName('cms_user','name',inputTrim($str));
$c2 = DB::countName('tmp_user','name',inputTrim($str));
$c += $c2;
if ($c > 0) {
  echo '<div class="alert-danger alert-password">
          <i class="far fa-thumbs-down"></i> Bereits vergeben
        </div>';
} else {
  echo '<div class="alert-success alert-password">
          <i class="far fa-thumbs-up"></i> Frei
        </div>';
}