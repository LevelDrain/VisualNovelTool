<?php
require 'function.php';

if (!empty($_POST)) {
    header('Content-type: text/plain; charset= UTF-8');

    if (isset($_POST['clicked'])) {

        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM textdata;');
        $query->execute();
        $dataArray = $query->fetchAll();

        $temp = [];
        $txtAry = [];
        foreach ($dataArray as $key => $dataCol) {
            foreach ($dbColumns as $colKey => $colValue) {
                //echo $colKey;
                if ($colKey !== 'id') {
                    $temp[$colKey] =  $dataCol[$colKey];
                }
            }
            $txtAry[] = $temp;
        }
        //http://agn.jp/blog/?p=2019

        $json = json_encode($txtAry, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    } else {
        echo 'FAIL TO AJAX REQUEST';
    }
}
