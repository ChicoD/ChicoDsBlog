<?php
    include_once("mysqlClass.php");
    include_once("articlesClass.php");
    include_once("adminClass.php");
    include_once("commentsClass.php");
    
    $mysql=new Mysql("localhost", "root", "", "mysql_database");
    $article=new Articles($mysql);
    $admin=new Admin();
    $comments=new Comments($mysql,"dan");
    
    $result=$comments->addComment(4,"textik","dan",1);
    echo("$result");
?>
