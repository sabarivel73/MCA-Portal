<?php
    session_start();
    include"database.php";
    if(!isset($_SESSION["ID"]))
    {
	    header("location:ulogin.php");
        exit();
    }
    $uid = $_SESSION["ID"];
    $cid = intval($_POST["cid"]);
    $c = $db->query("SELECT * FROM `like` WHERE UID = $uid AND CID = $cid");
    if($c->num_rows==0)
    {
        $db->query("INSERT INTO `like` (UID,CID) VALUES ($uid,$cid)");
    }
    header("Location: suggestion.php");
    exit();
?>