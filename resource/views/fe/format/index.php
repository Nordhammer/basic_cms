<?php
$per_page = 50;
$seite = ($_GET['seite'] ?? 1);
$seite2 = ($seite != 0 ? $seite-1:$seite);
$start = $seite2*$per_page;
$dbc = DB::exe("SELECT mediaID,topic,format FROM cms_media WHERE format = :id", array('id' => params($params[1])));
$db = DB::exe("SELECT mediaID,topic,format FROM cms_media WHERE format = :id LIMIT :start,:per_page ",array('id'=>params($params[1]),'start'=>$start,'per_page'=>$per_page));
if (isset($db)) {
    $res = '';
    foreach ($db as $r) {
        $data[] .= '<div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="card mb-5">
                            <img class="card-img img-fluid mx-auto d-block" src="https://img.ymdb.de/poster/thumbs/'.getMediaImage($r['mediaID']).'" alt="poster">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/media/'.$r['mediaID'].','.removeUglyChars4url(getMediaTopic($r['mediaID'])).'">'.getMediaTopic($r['mediaID']).'</a>
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
$template = new Template(TEMPLATE_PATH.'format/index.blade.php');
$cru = [
    ['path'=>'/start','title'=>'TITEL','topic'=>'Startseite'],
    ['topic'=>'Format']
];
$template->assign('breadcrumb',Breadcrumb::generate($cru));
// PAGINATION START
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
    $tpl->assign('path','format');
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