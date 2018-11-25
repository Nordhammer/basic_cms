<?php
$_CONF['tpl'] = [

  /* global */
  'start' => RESOURCE_PATH.'start/index.php',
  'error404' => RESOURCE_PATH.'error/error404.php',
  'wartung' => RESOURCE_PATH.'wartung/index.php',
  'kontakt' => RESOURCE_PATH.'kontakt/index.php',
  'hilfe' => RESOURCE_PATH.'hilfe/index.php',
  'datenschutz' => RESOURCE_PATH.'datenschutz/index.php',
  'impressum' => RESOURCE_PATH.'impressum/index.php',

  /* registrieren */
  'registrieren' => RESOURCE_PATH.'registrierung/index.php',
  'aktivieren' => RESOURCE_PATH.'registrierung/aktivieren.php',
  'kennwort-festlegen' => RESOURCE_PATH.'registrierung/kennwort_festlegen.php',

  /* anmelden */
  'anmelden' => RESOURCE_PATH.'anmeldung/index.php',
  'abmelden' => RESOURCE_PATH.'anmeldung/logout.php',
  'kennwort-wiederherstellen' => RESOURCE_PATH.'anmeldung/kennwort_wiederherstellen.php',

  /* suche */
  'suchergebnis' => RESOURCE_PATH.'suche/index.php',

  // user
  'profil' => RESOURCE_PATH.'profil/index.php',

  /* media */
  'format' => RESOURCE_PATH.'format/index.php',
  'media' => RESOURCE_PATH.'media/index.php',

];

$_CONF['acp'] = [

  /* global */
  'start' => RESOURCE_PATH.'start/index.php',
  
  /* wcp */
  'admin' => RESOURCE_PATH_ADMIN.'start/index.php',

];
