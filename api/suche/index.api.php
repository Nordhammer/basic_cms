<?php
// verbindung zur datenbank aufbauen
include_once 'config/database.php';
include_once 'class/database.php';
include_once 'function.php';
DB::connect($_CONF['db']['host'],$_CONF['db']['user'],$_CONF['db']['pw'],$_CONF['db']['name']);
// Abfrage der Schlüsselwörter
$db = DB::exe("SELECT DISTINCT * FROM cms_media WHERE topic LIKE :keys GROUP BY topic ORDER BY mediaID DESC LIMIT 5",array("keys"=>"%".inputTrim($_GET['q'])."%"));
if (isset($db)) {
	foreach ($db as $r) {
		echo '<li>';
		echo '	<a class="result" href="/media/'.$r['mediaID'].','.removeUglyChars4url($r['topic']).'">';
		echo $r['topic'];
		echo '	</a>';
		echo '</li>';
	}
}
