<?php

class DB {

  protected static $dbh;

  public static function connect($host, $username, $password, $database=null) {
    try {
      $database = ($database) ? ';dbname=' . $database : '';
      self::$dbh = new PDO('mysql:host=' . $host . $database, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      return;
    } catch(PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }

// DB::exe("SELECT * FROM cms_news WHERE newsID = :id",array('id'=>$id));

// DB::exe('SELECT * FROM cms_news ORDER BY newsID DESC LIMIT '$_CONF['limit']['home_news']'');

// DB::exe('INSERT INTO `tmp_cms_user` (`userID`, `username`, `password`, `usermail`, `userregtime`,`userIP`,`hash`) vales (:userID,:username,:password,:usermail,:userregtime,:userIP,:hash);',
// array('userID'=>NULL, 'username'=>'$_POST['signUsername']', 'password'=>'$password', 'useremail'=>'$_POST['_email']', 'userregtime'=>'CURRENT_TIMESTAMP', 'userIP'=>'$_SERVER['REMOTE_ADDR']', 'hash'=>'$hash'));

// DB::exe('UPDATE tabelle SET username = :username WHERE id = :id',array('id'=>1,'username'=>'Alfred'));

// DB::exe('DELETE FROM tabelle WHERE id = :id',array('id'=>1));

  public static function exe($sql, $para=null) {
    $para_copy = $para;
    $stmt = self::$dbh->prepare($sql);
    $bind_para = ($para !== null and (strpos($sql, ' LIMIT :') !== false or strpos($sql, ' limit :') !== false)) ? true : false;

    if($bind_para and is_array($para)) {
      foreach($para as $key => &$val) {
        if (is_string($val)) {
          $stmt->bindParam($key, $val, PDO::PARAM_STR);
        } elseif (is_bool($val)) {
          $stmt->bindParam($key, $val, PDO::PARAM_BOOL);
        } elseif (is_null($val)) {
          $stmt->bindParam($key, $val, PDO::PARAM_NULL);
        } elseif (is_numeric($val)) {
          $stmt->bindParam($key, $val, PDO::PARAM_INT);
        } else { // PDO::PARAM_FLOAT does not exist. handle float as string
          $stmt->bindParam($key, (string)$val, PDO::PARAM_STR);
        }
      }
      $para = null;
    }

    if(!$stmt->execute($para)) {
      $err_info   = $stmt->errorInfo();
      $sql_state  = $err_info[0];
      $ecode      = $err_info[1];
      $emsg       = $err_info[2];

      $sql_state  = '(SQLSTATE: ' . $sql_state . ')';
      $ecode      = '(eCode: ' . $ecode . ')';
      $emsg       = 'eMessage: ' . $emsg;

      $error = $sql_state . ' ' . $emsg . ' ' . $ecode;

      $sql = preg_replace('/\s+/', ' ', $sql);

      $para_sring = '';
      if ($para_copy) {
        foreach ($para_copy as $k => $v) {
          $para_sring .= ($para_sring === '') ? '' : '; ';
          $para_sring .= ((strpos($k, ':') !== false) ? '' : ':') . $k . ' => ' . $v;
        }
      }

      $error .= 'query: ' . $sql . ' para: ' . $para_sring;
      throw new Exception($error);
    }

    $result = null;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if ($result === null) {
        $result = array();
      }
      $result[] = $row;
    }
    $stmt = null;
    return $result;
  }

  // DB::count("TABELLE"); -> AUSLESEN ALLER TABELLEN
  public static function count($table) {
    $sql = "SELECT count(*) AS c FROM $table";
    $stmt = self::$dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchObject()->c;
  }

  // DB::countID("TABELLE","SPALTE","ID") => AUSLESEN EINES BESTIMMTEN WERTES
  public static function countID($table,$column,$id) {
    $sql = "SELECT count(*) AS c FROM $table WHERE $column = $id";
    $stmt = self::$dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchObject()->c;
  }

  // DB::countID("TABELLE","SPALTE","ID") => AUSLESEN ZWEIER BESTIMMTER WERTE
  public static function countIDandROW($table,$column,$cID,$row,$rID) {
    $sql = "SELECT count(*) AS c FROM $table WHERE $column = $cID AND $row = $rID";
    $stmt = self::$dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchObject()->c;
  }

  public static function countName($table,$column,$id) {
    $sql = "SELECT count(*) AS c FROM $table WHERE $column = '$id'";
    $stmt = self::$dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchObject()->c;
  }

  public static function lastInsertId() {
    return self::$dbh->lastInsertId();
  }

  public static function close() {
    self::$dbh = null;
  }

}