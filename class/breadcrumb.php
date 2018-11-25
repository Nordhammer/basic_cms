<?php
class Breadcrumb {

    function generate(array $data) {
        $ret = '<ol class="container">';
        $c = count($data);
        $i = 1;
        foreach($data as $link) {
            $active = null;
            if ($i != $c) {
                $ret .= '<li><a href="'.$link['path'].'" title="'.$link['title'].'">'.$link['topic'].'</a> / </li>';
            } else {
                $ret .= '<li>'.$link['topic'].'</li>';
            }
            $i++;
        }
        $ret .= '</ol>';
        return $ret;
    }

}