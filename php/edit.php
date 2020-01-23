<?php
require 'function.php';

$db = dbConnect();
$data = dbGetData($db, $_GET['id']);
$postValues = current($data);

if (isset($_POST['edit'])) {
    //取得（Read）
    //$postValues['id'] = $_POST['id'];
    $postValues['imageurl'] = $_POST['imageurl'];
    $postValues['position'] = $_POST['position'];
    $postValues['name'] = $_POST['name'];
    $postValues['serif'] = $_POST['serif'];
    $postValues['effect'] = $_POST['effect'];

    //編集（Update）
    $columnSql = [];
    foreach ($dbColumns as $key => $column) {
        if ($key !== 'id') {
            $columnSql[] = ' ' . $key . ' = :' . $key;
        }
    }

    $sql = 'UPDATE textdata SET' . implode(',', $columnSql) . ' WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $bindValues = [];
    foreach ($dbColumns as $key => $column) { //1レコード分の処理
        if ($key !== 'id') {
            $bindValues[$key] = $postValues[$key];
            $query->bindParam(':' . $key, $bindValues[$key]);
            // echo '<pre>';
            // var_dump($bindValues[$key]);
            // echo '</pre>';
        }
    }

    $edit = $query->execute();
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
    <title>編集</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/index2.css">
</head>

<body>
    <div id="container">
        <h2>編集</h2>

        <form action="edit.php?id=<?= htmlspecialchars($_GET['id']) ?>" enctype="multipart/form-data" method="post">
            <ul>
                <!-- TODO:並べ替えできるようにする。 -->
                <!--<li>
                    <label>■ 順序<br>
                        <input type="text" name="id" value="<?= $postValues['id'] ?? '' ?>">
                    </label>
                </li>-->
                <li>
                    <label>■ 画像ファイル名<br>
                        <input type="text" name="imageurl" value="<?= $postValues['imageurl'] ?? '' ?>">
                    </label>
                </li>
                <li>
                    ■ 画像の位置<br>
                    <label>
                        <input type="radio" name="position" value="right"
                            <?= $postValues['position'] === 'right' ? ' checked' : '' ?>>right
                    </label>
                    <label>
                        <input type="radio" name="position" value="left"
                            <?= $postValues['position'] === 'left' ? ' checked' : '' ?>>left
                    </label>
                </li>
                <li>
                    <label>■ キャラ名<br>
                        <input type="text" name="name" value="<?= $postValues['name'] ?? '' ?>">
                    </label>
                </li>
                <li>
                    <label>■ セリフ<br>
                        <textarea name="serif" rows="5" cols="50"><?= $postValues['serif'] ?? '' ?></textarea>
                    </label>
                </li>
                <li>
                    <label>■ エフェクト編集<br>
                        <input type="text" name="effect" value="<?= $postValues['effect'] ?? '' ?>">
                    </label>
                </li>
            </ul>
            <p>
                <button type="button" onclick="history.back()">← 戻る</button>
                <button type="submit" id="submit" name="edit">書き直す</button>
            </p>
        </form>
    </div>
</body>

</html>