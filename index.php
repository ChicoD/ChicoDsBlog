<?php
    include_once("mysqlClass.php");
    include_once("articlesClass.php");
    include_once("adminClass.php");
    include_once("commentsClass.php");
    
    $mysql=new Mysql("localhost", "root", "", "mysql_database");
    $article=new Articles($mysql);
    $admin=new Admin();
    $comments=new Comments($mysql,"jmeno");
    
    $result=$article->showArticle(13);
    echo("$result");
?>
