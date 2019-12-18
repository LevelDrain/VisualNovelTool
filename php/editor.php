<?php
require 'functions.php';

$db = dbConnect();
$threads = $db->query('SELECT * FROM textdata;');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ストーリーエディタ</title>
</head>

<body>
    <table>
        <tr>
            <?php foreach ($dbColumns as $column) : ?>
                <th><?= $column ?></th>
            <?php endforeach; ?>
        </tr>
        <td>操作</td>
    </table>
</body>

</html>