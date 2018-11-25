<?php
$per_page = 50;
$seite = ($_GET['seite'] ?? 1);
$seite2 = ($seite != 0 ? $seite-1:$seite);
$start = $seite2*$per_page;
if (isset($_POST['submit'])) {
    $_SESSION['hint'] = '';
    $_SESSION['msg'] = '';
    $q = '';
    $q = inputTrim($_POST['q']);
    $err = false;
    if (!empty($q)) {
        if (strlen($q) < '2') {
            $err = true;
            $_SESSION['hint'] = 'danger';
            $_SESSION['msg'] = "Deine Suchanfrage sollte mindestens 2 Zeichen enthalten";
        }
    }
    if ($err === false) {
        $dbc = DB::exe("SELECT DISTINCT * FROM cms_media WHERE topic = :keys AND active = :active", array("keys"=>"%".$q."%",':active'=>"1"));
        $db = DB::exe("SELECT DISTINCT * FROM cms_media WHERE topic LIKE :keys AND active = :active GROUP BY topic ORDER BY topic ASC, created ASC LIMIT :start,:per_page",array("keys"=>"%".$q."%",':active'=>"1",'start'=>$start,'per_page'=>$per_page));
        // $db = DB::exe("SELECT DISTINCT mediaID,topic,active,created FROM cms_media WHERE topic LIKE :keys AND active = :active GROUP BY topic ORDER BY created DESC,topic ASC",array("keys"=>"%".$q."%",':active'=>"1"));
        $res = '';
        if (isset($db)) {
            foreach($db as $r) {
                $data[] .= '<div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card mb-5">
                                    <img class="card-img img-fluid mx-auto d-block" src="https://img.ymdb.de/poster/thumbs/'.getMediaImage($r['mediaID']).'" alt="poster">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="media/'.$r['mediaID'].','.removeUglyChars4url(getMediaTopic($r['mediaID'])).'">'.getMediaTopic($r['mediaID']).'</a>
                                        </h4>
                                        <p class="card-text">
                                            '.contentCuts(getMediaContent($r['mediaID']),0,200).'
                                        </p>
                                    </div>
                                </div>
                            </div>';
            }
        } else {
            $data[] .= '<div>Kein eintrag</div>';
        }
    }
}
$template = new Template(TEMPLATE_PATH.'suche/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>'Zurück zur Startseite','topic'=>'Startseite'],
    ['topic'=>'Suchergebnis']
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
$pag = new Pagination();
$navi = $pag->paginate($dbc,$per_page);
$res = $data;
if (isset($res)) {
    $result = '';
    foreach ($res as $r) {
        $tpl = new Template(TEMPLATE_PATH.'pagination/result.blade.php');
        $tpl->assign('result',$r);
        $result .= $tpl->show();
    }
}
$template->assign('result',$result);
if (isset($navi)) {
    $pagination = '';
    $current  = $seite;
    $tpl = new Template(TEMPLATE_PATH.'pagination/paginate.blade.php');
    $tpl->assign('path','suchergebnis');
    $tpl->assign('begin',1);
    $tpl->assign('past',($seite != 1 ? $seite-1: 1));
    $tpl->assign('current',$current);
    $tpl->assign('pages',($pag->counts) );
    $tpl->assign('next',($seite != $pag->counts ? $seite+1: $pag->counts));
    $tpl->assign('last',($pag->counts ));
    $pagination .= $tpl->show();
}
$template->assign('pagination',$pagination);
// PAGINATION ENDE
echo $template->show();