<?php
if (isset($_POST['submit'])) {
    $_SESSION['hint'] = '';
    $_SESSION['msg'] = '';
    $name = '';
    $mail = '';
    $name = inputTrim($_POST['name']);
    $mail = inputTrim($_POST['mail']);
    $err = false;
    if (empty($mail)) {
        $err = true;
        $_SESSION['hint'] = 'danger';
        $_SESSION['msg'] = getUserLang('alerts.keine_mail');
    } else if (!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
        $err = true;
        $_SESSION['hint'] = 'danger';
        $_SESSION['msg'] = getUserLang('alerts.inkorrekte_mail');
    } else {
        $c = DB::countName('cms_user','mail',$mail);
        $c2 = DB::countName('tmp_user','mail',$mail);
        $c += $c2;
        if ($c !== 0) {
            $err = true;
            $_SESSION['hint'] = 'danger';
            $_SESSION['msg'] = getUserLang('alerts.doppelte_mail');
        }
    }
    if (empty($name)) {
        $err = true;
    } else {
		$str = strlen($name);
		if ($str < 3 OR $str > 25) {
			$err = true;
			$_SESSION['hint'] = 'info';
			$_SESSION['msg'] = getUserLang('alerts.korrekte_zeichenanzahl');
        } else {
            $c = DB::countName('cms_user','name',$name);
            $c2 = DB::countName('tmp_user','name',$name);
            $c += $c2;
            if ($c !== 0) {
                $err = true;
                $_SESSION['hint'] = 'danger';
                $_SESSION['msg'] = getUserLang('alerts.doppelter_nutzer');
            }
        }
    }
    if ($err === false) {
        $hash = md5(time());
        DB::exe("INSERT INTO `tmp_user` (`id`,`name`,`mail`,`hash`,`ip`,`created`) 
        VALUES (NULL,:name,:mail,:hash,:ip,:created)",array('name'=>$name,'mail'=>$mail,'hash'=>$hash,'ip'=>$_SERVER['REMOTE_ADDR'],'created'=>time()));
        $web = 'yourMDB';
        $url = 'https://yourmdb.de';
        $support = 'support@ymdb.de';
        $empfaenger = $mail; //Mailadresse
        $absender   = "yourMDB Team";
        $betreff    =  getUserLang('signup.email_topic').": ".$web;
        $antwortan  = "support@ymdb.de";
        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";
        $header .= "From: $absender\r\n";
        $header .= "Reply-To: $antwortan\r\n";
        // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
        $header .= "X-Mailer: PHP ". phpversion();
        $mailtext = '<html>
        <head>
            <title>'.$betreff.': '.$web.'</title>
        </head>
        <body>
            <h1 style="padding:20px 0 20px 30px;color:rgb(255,255,255);background:rgb(19,132,150);font-size:2rem;font-weight:400;">'.$web.'&reg;</h1>
            <div style="margin:0 30px">
                <h3>'.getUserLang('signup.hallo').' '.$name.',</h3>
                <p>'.getUserLang('signup.vielen_dank').' <a href="'.$url.'">'.$web.'</a>. '.getUserLang('signup.konto_bestaetigen').'</p>
                <a style="font-size:1.125rem;color:rgb(255,255,255);background:rgb(71,124,132);text-align:center;text-decoration:none;border-radius:3px;padding:5px 20px;" href="'.$url.'/aktivieren/'.$hash.'">'.getUserLang('signup.btn_konto_bestaetigen').'</a>
                <p>'.getUserLang('signup.konto_problem').' <a mailto="'.$support.'">'.$support.'</a>.</p>
                <p>'.getUserLang('signup.mail_ignorieren').'</p>
                <div style="color:rgb(215,215,215);text-align:center;border-top:.075rem solid rgb(225,225,225);margin-top:1rem;padding:1rem;">
                    '.getUserLang('global.yourmdb_filmdatenbank').'<br />
                    <a style="color:rgb(215,215,215);text-decoration:none;" href="'.$url.'">'.$url.'</a>
                </div>
            </div>
        </body>
        </html>';
        mail( $empfaenger, $betreff, $mailtext, $header);
        $_SESSION['hint'] = 'success';
        $_SESSION['msg'] = getUserLang('signup.mail_verschickt');
        header('Location: '.$url.'/');
    }
}
$template = new Template(TEMPLATE_PATH.'registrierung/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>getUserLang('breadcrumb.weiter_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
    ['topic'=>getUserLang('signup.registrierung')]
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$template->assign('signup.registrierung',getUserLang('signup.registrierung'));
$template->assign('signup.name',getUserLang('signup.name'));
$template->assign('signup.mail',getUserLang('signup.mail'));
$template->assign('signup.btn_konto_erstellen',getUserLang('signup.btn_konto_erstellen'));
$template->assign('name',$name);
$template->assign('mail',$mail);
echo $template->show();