<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method

    require_once("function.php");
    $db_link = db_connect();
    login();
    $sql_query = "INSERT INTO `product`(`name`, `price`, `description`, `origin`) VALUES ('{$_POST['name']}','{$_POST['price']}','{$_POST['description']}','{$_POST['origin']}')
        ";
    $result = mysqli_query($db_link, $sql_query) or die("新增失敗");
    $id = mysqli_insert_id($db_link);
    # 檢查檔案是否上傳成功
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        echo '檔案名稱: ' . $_FILES['image']['name'] . '<br/>';
        echo '檔案類型: ' . $_FILES['image']['type'] . '<br/>';
        echo '檔案大小: ' . ($_FILES['image']['size'] / 1024) . ' KB<br/>';
        echo '暫存名稱: ' . $_FILES['image']['tmp_name'] . '<br/>';


        $extension = file_ext($_FILES['image']['name']);
        $file = $_FILES['image']['tmp_name'];
        $dest = 'upload/' . $id . '.'.$extension;

        # 將檔案移至指定位置
        move_uploaded_File($file, $dest);
    } else {
        echo '錯誤代碼：' . $_FILES['image']['error'] . '<br/>';
    }
    header('Location: http://localhost/MY/home');
    exit();
}
?>
<html>

<head>
    <title>COFE_add</title>
</head>

<body>
    <form action="add.php" method="post">
        商品名稱:<input type="text" name="name"><br>
        商品價錢:<input type="text" name="price"><br>
        商品描述:<textarea name="description" cols="30" rows="10"></textarea><br>
        商品產地:<input type="text" name="origin"><br>
        <input type="submit" value="新增商品資料">
    </form>
</body>

</html>