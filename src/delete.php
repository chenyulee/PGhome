<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // The request is using the POST method
 
        require_once("function.php");
        $db_link=db_connect();
        login();
        $sql_query="DELETE FROM `product` WHERE `id`=" . $_GET['id'];
        $result = mysqli_query($db_link,$sql_query) or die("新增失敗");
        
        header('Location: http://localhost/MY/home');
        exit();

    }
?>
<html>
    <head>
        <title>COFE_add</title>
    </head>
    <body>

    </body>
</html>