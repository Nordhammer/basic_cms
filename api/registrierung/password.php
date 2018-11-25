<?php
$passwort = '';
if (isset($_GET['q'])) {
  $passwort = $_GET['q'];
}
$sicherheitszahl = 0;
$sicherheitszahl = strlen($passwort);
if (preg_match("/[a-z]/", $passwort)) {
    $sicherheitszahl = $sicherheitszahl + 5;
}
if (preg_match("/[A-Z]/", $passwort)) {
    $sicherheitszahl = $sicherheitszahl + 5;
}
if (preg_match("/[0-9]/", $passwort)) {
    $sicherheitszahl = $sicherheitszahl + 5;
}
if (preg_match("/[,.-;:_@€#*+~?=()%$!§]/", $passwort)) {
  $sicherheitszahl = $sicherheitszahl + 5;
}
if ($sicherheitszahl <= 18 ) {
  echo '<div class="alert-danger">
          <i class="far fa-thumbs-down"></i> unsicher
        </div>';
}
elseif ($sicherheitszahl <= 25) {
  echo '<div class="alert-warning">
          <i class="far fa-thumbs-up"></i> sicher
        </div>';
}
elseif ($sicherheitszahl > 25) {
  echo '<div class="alert-success">
          <i class="far fa-thumbs-up"></i> sehr sicher
        </div>';
}