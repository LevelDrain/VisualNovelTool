<?php
require 'function.php';

// データ読み込み（Read）
$db = dbConnect();
$threads = $db->query('SELECT * FROM textdata;');
$threads->execute();

// データ作成（Create）
if(isset($_POST['insert'])){
    $insert=$db->prepare('INSERT INTO textdata (imageurl, position, name, serif, effect) values(:imageurl, :position, :name, :serif, :effect)');
    $insert->bindParam(':imageurl',$_POST['imageurl'],PDO::PARAM_STR);
    $insert->bindParam(':position',$_POST['position'],PDO::PARAM_STR);
    $insert->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
    $insert->bindParam(':serif',$_POST['serif'],PDO::PARAM_STR);
    $insert->bindParam(':effect',$_POST['effect'],PDO::PARAM_STR);
    $insert->execute();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>セリフ入力画面</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/index2.css">
</head>

<body>
    <div id="container">
        <h1>セリフ入力画面</h1>

        <form action="index.php" enctype="multipart/form-data" method="post">
            <ul>
                <li>✎ 追記</li>
                <li>
                    ※ 順序は自動で追加されます。並べ替えは「編集」から行ってください。
                </li>
                <li>
                    <label>■ 画像ファイル名<br>
                        <input type="text" name="imageurl" placeholder="参照画像ファイル">
                    </label>
                </li>
                <li>
                    ■ 画像の位置<br>
                    <label>
                        <input type="radio" name="position" value="right" checked>right
                    </label>
                    <label>
                        <input type="radio" name="position" value="left">left
                    </label>
                </li>
                <li>
                    <label>■ キャラ名<br>
                        <input type="text" name="name" placeholder="表示名">
                    </label>
                </li>
                <li>
                    <label>■ セリフ<br>
                        <textarea name="serif" rows="5" cols="50"></textarea>
                    </label>
                </li>
                <li>
                    <label>■ エフェクト<br>
                        <input type="text" name="effect" placeholder="エフェクト">
                    </label>
                </li>
            </ul>
            <p>
                <button type="submit" id="submit" name="insert">追加</button>
            </p>
        </form>

        <hr>
        <table>
            <tr>
                <?php foreach ($dbColumns as $column) : ?>
                <th><?= $column ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($threads as $thread) : ?>
            <tr>
                <?php foreach ($dbColumns as $key => $column) : ?>
                <td><?= isset($thread[$key]) ? htmlspecialchars($thread[$key]) : '' ?></td>
                <?php endforeach; ?>
                <td>
                    <a href="edit.php?id=<?= htmlspecialchars($thread['id']) ?>">編集</a>
                    <a href="delete.php?id=<?= htmlspecialchars($thread['id']) ?>">削除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>