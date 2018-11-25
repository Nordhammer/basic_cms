<?php
class Pagination {

    public $data;
    public $counts;
// $values könnte auch der count der datenbank einträge sein
//
    function paginate($values,$per_page=25) {
        $total_values = count($values);
        if (isset($_GET['seite'])) {
            $current = $_GET['seite'];
        } else {
            $current = 1;
        }
        $counts = ceil($total_values / $per_page);
        $this->counts = $counts;
        $param1 = ($current - 1) * $per_page;
        $this->data = array_slice($values,$param1,$per_page);
        for ($x=1; $x<=$counts; $x++) {
            $numbers[] = $x;
        }
        return $numbers;
    }

    function fetchResult() {
        $resultsValues = $this->data;
        return $resultsValues;
    }

}