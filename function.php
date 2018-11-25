<?php
// prüft ob user berechtigung für seite hat z.B. bouncer(isAdmin());
function bouncer($data) {
    if ($data == false) {
        return header('Location: http://'.getConfig('DOMAIN').'/');
    }
}
//
function isAdmin() {
    if ((!isset($_SESSION['group']))) {
        return false;
    } else if ($_SESSION['group'] == ADMIN_RANK) {
        return true;
    }
    return false;
}
//
function isMod() {
    if ((!isset($_SESSION['group']))) {
        return false;
    } else if ($_SESSION['group'] == ADMIN_RANK) {
        return true;
    } else if ($_SESSION['group'] == MOD_RANK) {
        return true;
    }
    return false;
}
//
function isUser() {
    if ((!isset($_SESSION['group']))) {
        return false;
    } else if ($_SESSION['group'] == ADMIN_RANK) {
        return true;
    } else if ($_SESSION['group'] == MOD_RANK) {
        return true;
    } else if ($_SESSION['group'] == USER_RANK) {
        return true;
    }
    return false;
}
// prüft den url_pfad auf richtigkeit
function params($params) {
    if (isset($params) && (int)$params > 0) {
        return $params = (int)$params;
    } else {
        return $params = '';
    }
}
// erzeugt zeilenumbrüche
function makeUp($str) {
    return nl2br($str);
}
// entfernt unerwünschte einträge wie scriptcodes
function clearContent($str) {
    return htmlspecialchars($str);
}
// wandelt den pfad um
function removeUglyChars4url($phrase) {
    // ersetzen durch
      $phrase = str_replace(array(' ', ':', '.', ';', ',', '(', ')', '[', ']', '?', '!', '`', '*', '§', ' - ', "'", '+', '!', ',', '#', '€', '@', '`'), "-",
      str_replace(array('&', '²', '³', 'ü', 'ä', 'ö', 'á', 'é'),
      array('und', '2', '3', 'ue', 'ae', 'oe', 'a', 'e'),$phrase));
    // ersetze alle Zeichen durch ...
    while (strpos($phrase, "__") !== false) $phrase = str_replace("__", "-", $phrase);
    while (strpos($phrase, "_-_") !== false) $phrase = str_replace("_-_", "-", $phrase);
    while (strpos($phrase, "--") !== false) $phrase = str_replace("--", "-", $phrase);
    $phrase = strtolower($phrase);
    return trim($phrase);
}
//
function removeUglyChars4Img($str) {
    $phrase = str_replace(array('*', '+', '!', '#', '€', '@', '}', '{', "`", "'", ':', '.', ';', ',', '(', ')', '[', ']', '?', '!', '&', '²', '³'),"_",strtolower($str));
    // ersetze alle Zeichen durch ...
    while (strpos($phrase, "__") !== false) $phrase = str_replace("__", "-", $phrase);
    while (strpos($phrase, "_-_") !== false) $phrase = str_replace("_-_", "-", $phrase);
    while (strpos($phrase, "--") !== false) $phrase = str_replace("--", "-", $phrase);
    return trim($phrase);
}
// gibt nur den ersten absatz aus
function first_paragraph($data,$str) {
    $array = explode("\n",$data,2); 
    switch ($str) {
        case '0':
        return $array[0]."<br />\n";
        break;
        case '1':
        return $array[0]."<br />\n";
        break;
    }
}
// passwort erstellen ganz  einfach.
function generatePassword($length = 8) {
    $aChr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
  $aOChr = ['@', 'µ', '$', '§', ':', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '{', '}', '(', ')', '*'];
  $password = '';
  for ($i = 0; $i < $length; $i++) {
        $rand = array_rand([true, false]);
    if ($rand == true) {
      if (array_rand([true, false]) == true) {
        $password .= strtoupper($aChr[rand(0, count($aChr) - 1)]);
      } else {
        $password .= $aChr[rand(0, count($aChr) - 1)];
      }
    } else {
      $password .= $aOChr[rand(0, count($aOChr) - 1)];
    }
  }
  return $password;
}
// läd den titel der medien
function getMediaTopic($alias) {
    $db = DB::exe("SELECT mediaID,topic FROM cms_media WHERE mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['topic'];
        }
    } else {
        return null;
    }
}
// läd den originaltitel der medien
function getMediaOriginalTopic($alias) {
    $db = DB::exe("SELECT mediaID,original FROM cms_media WHERE mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['original'];
        }
    } else {
        return null;
    }
}
// läd das herstellungsjahr der medien
function getMediaYear($alias) {
    $db = DB::exe("SELECT mediaID,year FROM cms_media WHERE mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['year'];
        }
    } else {
        return null;
    }
}
// läd den inhalt der medien
function getMediaContent($alias) {
    $db = DB::exe("SELECT mediaID,content FROM cms_media WHERE mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['content'];
        }
    } else {
        return null;
    }
}
// läd die poster der medien
function getMediaImage($alias) {
    $db = DB::exe("SELECT mediaID,image FROM cms_media WHERE mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['image'];
        }
    } else {
        return null;
    }
}
// läd die genre der medien
function getMediaGenre($alias) {
    $db = DB::exe("SELECT
        cms_media_genre.mediaID,
        cms_media_genre.value,
        fml_genre.id,
        fml_genre.genre
    FROM cms_media_genre
    LEFT JOIN fml_genre
    ON cms_media_genre.value = fml_genre.id
    WHERE cms_media_genre.mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            $str .= $r['genre'].', ';
            return $str;
        }
    } else {
        return null;
    }
}
// läd darsteller der medien
function getMediaActor($alias) {
    $db = DB::exe("SELECT
        cms_person.personID,
        cms_person.fullname,
        cms_media_actor.actorMID,
        cms_media_actor.actor
    FROM cms_person
    LEFT JOIN cms_media_actor
    ON cms_media_actor.actor = cms_person.personID
    WHERE cms_media_actor.actorMID = :id
    ORDER BY cms_person.personID ASC",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            $data .= $r['fullname']. ', ';
            return $data;
        }
    }
}
// läd die id des format (film, serie usw.) der medien
function getMediaFormatID($alias) {
    $db = DB::exe("SELECT mediaID,format FROM cms_media WHERE mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['format'];
        }
    } else {
        return null;
    }
}
// läd das format (film, serie usw.) der medien
function getMediaFormat($alias) {
    $db = DB::exe("SELECT
    cms_media.mediaID,
    cms_media.format,
    fml_format.id,
    fml_format.value
    FROM cms_media
    LEFT JOIN fml_format
    ON cms_media.format = fml_format.id
    WHERE cms_media.mediaID = :id",array('id'=>$alias));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['value'];
        }
    } else {
        return null;
    }
}
// string kürzen
// $str => der zu kürzende string
// $start => ab welchem zeichen gezählt wird,zB. 0
// $length => wieviele zeichen am ende abgezogen werden, zB. -2 = (, )
// strCutter($str,0,-2);
function strCutter($str,$sta,$len) {
    return substr($str,$sta,$len);
}
// 
function contentCuts($str,$sta,$len) {
    if (strlen($str) > $len) {
      return substr($str,(int)$sta,(int)$len).' ...';
    } else {
        return null;
    }
}

// gibt das geschlecht des users aus
function getUserGender($id) {
    $db = DB::exe("SELECT gender FROM cms_user WHERE userID = :id",array('id'=>$id));
    if (isset($db)) {
        foreach ($db as $r) {
            switch ($r['gender']) {
                case '0':
                $str = getUserLang('global.unbekannt');
                break;
                case '1':
                $str = getUserLang('global.weiblich');
                break;
                case '2':
                $str = getUserLang('global.maennlich');
                break;
                default:
                break;
            }
        }
    }
    return $str;
}



/*
function getUserLang($data) {
    $lang = $_SESSION['lang'] ?? 'de';
    $input = explode('.', $data);
    echo explode('.', $data)[1];
    $file = "resource/lang/$lang/".$input[0].'.php';
    if (file_exists($file)) {
        $arr = include "$file";
        $c = count($input);













        for ($i=1; $i<$c; $i++) {
            foreach ($input as $rec) {




                return $arr[$rec[$i]];





            }
        }
    }
    return null;




}



/*
function getUserLang($data) {
    $lang = $_SESSION['lang'] ?? 'de';
    $input = explode('.', $data);
    echo explode('.', $data)[1];
    $file = "resource/lang/$lang/".$input[0].'.php';
    if (file_exists($file)) {
        $arr = include "$file";
        return $arr[$input[1]] ?? '';
    }
    return '';
}

*/

function getUserLang($data) {
    return @(include 'resource/lang/'.($_SESSION['lang'] ?? 'de').'/'.explode('.', $data)[0].'.php')[explode('.', $data)[1]] ?? '';
}

function checkEmail($mail) {
    $find1 = strpos($mail, '@');
    $find2 = strpos($mail, '.');
    return ($find1 !== false && $find2 !== false && $find2 > $find1 ? true : false);
 }

 function checkUser() {

 }

/*
function getUserLang($data) {
    $lang = $_SESSION['lang'] ?? 'de';
    $filename = substr($data, 0, strpos($data, '.'));
    $key = substr($data, strpos($data, '.') + 1);
    $arr = explode('.', $key);
    $file = "resource/lang/".$lang."/".$filename.'.php';
    $str = '';
    if (file_exists($file)) {
        $arrFile = include "$file";
        $ret = '';
        if (is_array($arrFile) && array_key_exists($key, $arrFile)) {
            $ret = $arrFile[$key];
        } else {
            foreach ($arr as $a) {
                if (is_array($arrFile) && array_key_exists($a, $arrFile)) {
                    $ret = $arrFile = $arrFile[$a];
                } else {
                    $ret = '';
                    break;
                }
            }
        }
        return $ret;
    }
}

/*

    if ((!isset($_SESSION['lang']))) {
        $lang = NATIVE_LANGUAGE;
    } else {
        $lang = $_SESSION['lang'];
    }
    if (isset($alias)) {
        // string anhand der "." trennen
        $str = explode('.',$alias);
        // einzelne teile zählen
        $c = count($str);
        // leeres array erzeugen
        $data = array();
        // an erster stelle die sprache (zb. "de") setzen
        $data[0] = $lang;
        // per schleife array erweitern
        for ($i=1; $i<$c; $i++) {
            foreach ($str as $rec) {
                $data[$i] = $rec;
            }
        }
        // rückgabe des array
        return $data;
    }
}

 getUserLang('breadcrumb.startseite');


*/











// bearbeitet das datum
function editDateFromDB($created) {
    $months = array(1=>getUserLang('global.monat_januar'),
                    2=>getUserLang('global.monat_februar'),
                    3=>getUserLang('global.monat_maerz'),
                    4=>getUserLang('global.monat_april'),
                    5=>getUserLang('global.monat_mai'),
                    6=>getUserLang('global.monat_juni'),
                    7=>getUserLang('global.monat_juli'),
                    8=>getUserLang('global.monat_august'),
                    9=>getUserLang('global.monat_september'),
                    10=>getUserLang('global.monat_oktober'),
                    11=>getUserLang('global.monat_november'),
                    12=>getUserLang('global.monat_dezember')
    );
    return date('d',$created).". ".$months[date('n',$created)]." ".date('Y',$created);
}
// bearbeitet das zeitformat
function editTimeFromDB($created) {
    return date('H:i',$created);
}
// kleinschreibung erzwingen
function lowercase($str) {
    return strtolower($str);
}
// leerzeichen vor- und hinter dem string entfernen
function inputTrim($str) {
    return trim(rtrim($str));
}



// einstellungen aus der db laden
function getConfig($alias) {
    $db = DB::exe("SELECT alias,value FROM wcp_config WHERE alias = :alias",array('alias'=>strtoupper($alias)));
    if (isset($db)) {
        foreach ($db as $r) {
            return $r['value'];
        }
    } else {
        return null;
    }
}

