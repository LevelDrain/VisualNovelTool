<?php
require 'function.php';

if(isset($_FILES['userfile'])) {
    $uploadDir='../img/';
    $message='';

    foreach ($_FILES["userfile"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["userfile"]["tmp_name"][$key];
            $name = basename($_FILES["userfile"]["name"][$key]);
            move_uploaded_file($tmp_name, "$uploadDir/$name");
            //echo $name." → アップロードに成功しました。\n"; 
            $message = $name." → アップロードに成功しました。\n";
        }else{
            //エラーが発生している
            if($_FILES['userfile']['error'] == UPLOAD_ERR_INI_SIZE){
                echo "アップロードされたファイルが大きすぎます。";
            }else if($_FILES['userfile']['error'] == UPLOAD_ERR_FORM_SIZE){
                echo "アップロード上限は 10MB です。";
            }else if($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE){
                echo "アップロードに失敗しました。";  
            }else{
                echo "原因不明のエラーが発生しています(ERR=".print_r($_FILES['userfile']['error'],true).")";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>画像アップロード</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/index2.css">
</head>

<body>
    <div id="container">
        <h1>画像アップロード</h1>

        <form action="upload.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <p>
                <label>■ 画像 : <input name="userfile[]" type="file" multiple="true"></label>
                <br>※ アップロードできるもの png, jpg, jpeg, gif
            </p>
            <p><button type="submit" id="submit" name="upload">アップロード</button></p>
        </form>
        <p><?= isset($message) ? $message : '' ?></p>
    </div>
</body>

</html>