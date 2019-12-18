<?php
function dbConnect()
{
    $dbHost = 'localhost';
    $dbName = 'project2019';
    $dbUser = 'mediaserver';
    $dbPass = '2018f';
    try {
        $db = new PDO(
            'mysql:host=' . $dbHost .
                ';dbname=' . $dbName .
                ';charset=utf8',
            $dbUser,
            $dbPass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $db;
    } catch (PDOException $e) {
        exit('DB接続失敗 ' . $e->getMessage());
    }
}

$dbColumns = [
    'id' => '順序',
    'imageurl' => '画像ファイル名',
    'position' => '画像の位置',
    'name' => 'キャラ名',
    'serif' => 'セリフ',
    'effect' => 'エフェクト'
];
