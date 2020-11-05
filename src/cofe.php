<!DOCTYPE html>
<html>
    <head>
        <title>Cofe_showmenu</title>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    </head>
    <body>
    <?php
    $db_link=mysqli_connect("localhost","root","aaaa0000*","bigtest");
    if(mysqli_connect_errno($db_link))
    {
        die ("連接 MYAQL 失敗:" . mysqli_connect_errno());
    }
    mysqli_set_charset($db_link,"utf8");
    $sql_query="SELECT *FROM product";
    $result = mysqli_query($db_link,$sql_query);
    
    ?>
    <table>
        <?php while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){?>
        <tr>
            <td><?php echo $row["id"];?></td>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["price"];?></td>
        </tr>
    <?php } ?>
    </table>
    </body>
</html>