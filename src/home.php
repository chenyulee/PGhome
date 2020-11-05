<!DOCTYPE html> 
   <?php
        require_once("function.php");
        login();
        $db_link=db_connect();
        $sql_query="SELECT *FROM product";
        $result = mysqli_query($db_link,$sql_query);
        
    ?>
<html>
    <head>
        <title>Cofe</title>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    </head>
    <body>
    <div class="container-fluid">
    <?php echo $_SESSION['pass'].',您好!' ?>
    <a href="logout.php">登出</a>
    <div class="row">
        <div class="col-sm-7">
            <table class="table table-hover">
                <?php while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){?>
                <tr>
                    <td><?php echo $row["id"];?></td>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["price"];?></td>
                    <td><a href="<?php echo "delete.php?id=".$row["id"] ?>">delete</a></td>
                    <td><a href="<?php echo "select.php?id=".$row["id"] ?>">update</a></td>
                    <td><img style="width:128px;" src='/MY/upload/<?php echo file_scan(''.$row["id"]) ;?>'></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col-sm-5">
            <form action="add.php" enctype="multipart/form-data" method="post"> 
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">商品名稱:</label>
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">商品價錢:</label>
                    <div class="col-sm-5">
                        <input type="text" name="price" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label"> 商品描述:</label>
                    <div class="col-sm-5">
                        <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label"> 商品產地:</label>
                    <div class="col-sm-5">
                        <input type="text" name="origin" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> 商品圖片:</label>
                    <div class="col-sm-5">
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <input type="submit" value="新增商品資料" class="btn btn-primary mb-2">
                
            </form>
           
        </div>
     </div>
       
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

    </body>
</html>