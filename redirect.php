<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $DBname = "diary";
    $conn = new PDO("mysql:host=$servername;dbname=$DBname;", $username,"", array(PDO::ATTR_PERSISTENT => true));
    $conn->exec("set names utf8");

    $t= $_GET['t'];
    $date= $_GET['date'];
    $id= isset($_GET['id'])?$_GET['id']:'';
    if($t == "done"){
        $done= 1;
        $sql="update note set n_done= !n_done where n_id='$id'";
        $stmt= $conn->query($sql);
    }
    $_SESSION['selected']= $date;
	echo' <meta http-equiv="refresh" content="0; url=note.php?d=d">';
?>
