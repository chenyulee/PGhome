<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    if ($_POST['password'] != $_POST['password_check']) {
        $error = '密碼不一致';
    } else {
        require_once("function.php");
        $db_link = db_connect();
        $sql_query = "SELECT * FROM `user` WHERE `name`='" . $_POST['name'] . "'";
        $result = mysqli_query($db_link, $sql_query) or die("失敗");
        $user = mysqli_fetch_array($result);
        if ($user !== null && $user !== false) {
            $error_name = '已有相同帳號';
        } else {
            $sql_query = "INSERT INTO `user` ( `name`, `password`, `gender`) VALUES ('{$_POST['name']}','{$_POST['password']}','{$_POST['gender']}')
                ";
            $result = mysqli_query($db_link, $sql_query) or die("新增失敗");
            header('Location: http://localhost/MY/home.php');
            exit();
        }
    }
}
?>
<html>

<head>
    <title>COFE_會員註冊</title>
</head>

<body>

    <form action="member.php" method="post" align="center">
        <p>
            <font size=+3>註冊會員</font>
        </p>
        帳號:<input type="text" name="name" value="<?php if (isset($_POST['name'])) {
                                                        echo $_POST['name'];
                                                    } ?>"><br>
        <div style="color:#ff0000;"><?php
                                    if (isset($error_name)) {
                                        echo $error_name;
                                    }

                                    ?></div>
        密碼:<input type="password" name="password"><br>
        密碼確認:<input type="password" name="password_check"><br>
        <div style="color:#ff0000;"><?php
                                    if (isset($error)) {
                                        echo $error;
                                    }

                                    ?></div>
        性別:<input type="radio"" name=" gender" value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male') {
                                                                echo 'checked';
                                                            } ?>> 男
        <input type="radio"" name=" gender" value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'female') {
                                                                echo 'checked';
                                                            } ?>> 女<br>
        <input type="submit" value="送出">
    </form>
</body>

</html>