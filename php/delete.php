<?php
require 'function.php';

$db = dbConnect();
$data = dbGetData($db, $_GET['id']);
$postValues = current($data);

if (isset($_POST['delete'])) {
    //削除（delete）
    $query = $db->prepare('DELETE FROM textdata WHERE id = :id;');
    $query->bindParam(':id',$_GET['id'],PDO::PARAM_INT);
    $delete = $query->execute();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>削除</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/index2.css">
</head>

<body>
    <div id="container">
        <h2>削除</h2>

        <form action="delete.php?id=<?= htmlspecialchars($_GET['id']) ?>" enctype="multipart/form-data" method="post">
            <ul>
                <!-- TODO:並べ替えできるようにする。 -->
                <!--<li>
                    ■ 順序：
                    <?= $postValues['id'] ?>
                </li>-->
                <li>
                    ■ 画像ファイル名：
                    <?= $postValues['imageurl'] != '' ? $postValues['imageurl'] : '設定なし' ?>
                </li>
                <li>
                    ■ 画像の位置：
                    <?= $postValues['position'] != '' ? $postValues['position'] : '設定なし' ?>
                </li>
                <li>
                    ■ キャラ名：
                    <?= $postValues['name'] != '' ? $postValues['name'] : '設定なし' ?>
                </li>
                <li>
                    ■ セリフ<br>
                    <?= $postValues['serif'] != '' ? $postValues['serif'] : '設定なし' ?>
                </li>
                <li>
                    ■ エフェクト：
                    <?= $postValues['effect'] != '' ? $postValues['effect'] : '設定なし' ?>
                </li>
            </ul>
            <p>
                <button type="button" onclick="history.back()">← 戻る</button>
                <button type="submit" id="submit" name="delete">削除</button>
            </p>
        </form>
    </div>
</body>

</html>