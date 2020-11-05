<?php
require_once("function.php");
$db_link = db_connect();
login();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql_query = "SELECT * FROM `product` WHERE `id`=" . $_GET['id'];
    $result = mysqli_query($db_link, $sql_query) or die("新增失敗");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        echo '檔案名稱: ' . $_FILES['image']['name'] . '<br/>';
        echo '檔案類型: ' . $_FILES['image']['type'] . '<br/>';
        echo '檔案大小: ' . ($_FILES['image']['size'] / 1024) . ' KB<br/>';
        echo '暫存名稱: ' . $_FILES['image']['tmp_name'] . '<br/>';

        $id = $_GET['id'];
        $extension = file_ext($_FILES['image']['name']);
        $file = $_FILES['image']['tmp_name'];
        $dest = 'upload/' . $id . '.' . $extension;

        # 將檔案移至指定位置
        move_uploaded_File($file, $dest);
    } else {
        echo '錯誤代碼：' . $_FILES['image']['error'] . '<br/>';
    }
    $sql_query = "UPDATE `product`set `name`='{$_POST['name']}',`price`='{$_POST['price']}',`description`='{$_POST['description']}',`origin`='{$_POST['origin']}' WHERE `id`=" . $_GET['id'];
    $result = mysqli_query($db_link, $sql_query) or die("新增失敗");
    header('Location: http://localhost/MY/home');
    exit();
}
?>
<html>

<head>
    <title>COFE_add</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
</head>

<body>

    <form action="select.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">商品名稱:</label>
            <div class="col-sm-5">
                <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">商品價錢:</label>
            <div class="col-sm-5">
                <input type="text" name="price" value="<?php echo $row['price'] ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label"> 商品描述:</label>
            <div class="col-sm-5">
                <textarea name="description" cols="30" rows="10" class="form-control"><?php echo $row['description'] ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label"> 商品產地:</label>
            <div class="col-sm-5">
                <input type="text" name="origin" value="<?php echo $row['origin'] ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"> 商品圖片:</label>
            <div class="col-sm-5">
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <input type="submit" value="修改" class="btn btn-primary mb-2">

    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

</body>

</html>