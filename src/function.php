<?php
require_once("config.php");
function start_session($expire = 0)
{
    if ($expire == 0) {
        $expire = ini_get('session.gc_maxlifetime');
    } else {
        ini_set('session.gc_maxlifetime', $expire);
    }

    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire);
        session_start();
    } else {
        session_start();
        setcookie('PHPSESSID', session_id(), time() + $expire);
    }
}
function db_connect()
{
    global $DB_USER, $DB_PASSWORD, $DB_DBNAME;
    $db_link = mysqli_connect("localhost", $DB_USER, $DB_PASSWORD, $DB_DBNAME);
    if (mysqli_connect_errno($db_link)) {
        die("連接 MYAQL 失敗:" . mysqli_connect_errno());
    }
    mysqli_set_charset($db_link, "utf8");
    return $db_link;
}
function login()
{
    global $TIMEOUT;
    start_session($TIMEOUT);

    if (isset($_SESSION['pass'])) {
        return;
    }
    if (!array_key_exists('id', $_POST)) {
        header('Location: http://localhost/MY/login.php?error=登入失敗!');
    }
    $db_id = db_connect();
    $sql_query = "SELECT * FROM `user` WHERE `name`='" . $_POST['id'] . "'";
    $result = mysqli_query($db_id, $sql_query) or die("查無此帳號");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($_POST['password'] == $row['password']) {
        $_SESSION['pass'] = $_POST['id'];
    } else {
        header('Location: http://localhost/MY/login.php?error=登入失敗!');
    }
}
function file_ext($str)
{
    $str_sec = explode(".", $str);
    return $str_sec[1];
}
function file_scan($id)
{
    $dir = 'upload/';
    $file = scandir($dir);
    foreach ($file as $me) {

        $str_sec = explode(".", $me);
        if ($str_sec[0] == $id) {
            return $me;
        }
    }
    return '';
}
