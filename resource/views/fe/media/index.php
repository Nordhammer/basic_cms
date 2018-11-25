<?php
$template = new Template(TEMPLATE_PATH.'media/index.blade.php');
$db = DB::exe("SELECT mediaID,active,created FROM cms_media WHERE mediaID = :id AND active = :active GROUP BY topic ORDER BY created DESC,topic ASC",array("id"=>params($params[1]),':active'=>"1"));
if (isset($db)) {
    foreach($db as $r) {
        $cru = [
            ['path'=>'/start','title'=>getUserLang('breadcrumb.zurueck_zu_start'),'topic'=>getUserLang('breadcrumb.start')],
            ['path'=>'/format/'.getMediaFormatID($r['mediaID']).','.removeUglyChars4url(getMediaFormat($r['mediaID'])),'title'=>getUserLang('breadcrumb.weiter_zu').' '.getMediaFormat($r['mediaID']),'topic'=>getMediaFormat($r['mediaID'])],
            ['topic'=>getMediaTopic($r['mediaID'])]
        ];
        $template->assign('breadcrumb',Breadcrumb::generate($cru));
        $template->assign('path','/media/'.$r['mediaID'].','.removeUglyChars4url(getMediaTopic($r['mediaID'])));
        $template->assign('topic',getMediaTopic($r['mediaID']));
        $template->assign('original',getMediaOriginalTopic($r['mediaID']));
        $template->assign('year','('.getMediaYear($r['mediaID']).')');
        $template->assign('genres',strCutter(getMediaGenre($r['mediaID']),0,-2));
        $template->assign('content',getMediaContent($r['mediaID']));
        $template->assign('image','https://img.ymdb.de/poster/thumbs/'.getMediaImage($r['mediaID']));
    }
    $res = '';
    $tpl = new Template(TEMPLATE_PATH.'media/actor.blade.php');
    $tpl->assign('actor',getMediaActor($r['mediaID']));
    $res .= $tpl->show();
}
$template->assign('actors',$res);
// sprache
$template->assign('media.originaltitel',getUserLang('media.originaltitel'));
$template->assign('media.darsteller',getUserLang('media.darsteller'));
// ausgabe
echo $template->show();