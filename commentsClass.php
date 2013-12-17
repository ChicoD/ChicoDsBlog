<?php
 
 class Comments
 {

   private $mysql;

   private $adminNick;

   public function __construct (&$MySQL, $adminNick)

   {
    $this->mysql=$MySQL;
    $this->adminNick=$adminNick;
   }

   public function addComment ($articleId, $text, $nick, $isAdmin)

   {
      $num_rows = $this->mysql->numberOfResults("Select * from `articles` where `id`=$articleId");
      if($text && $num_rows>0 && $nick)
      {
        $text=htmlspecialchars($text);
        $nick=ltrim($nick);
        $nick=rtrim($nick);  
      }
      else return false; 
      
      
      if($nick!=$this->adminNick)
      {
        $this->mysql->numberOfResults("INSERT INTO `comments` values ('','$text','$nick')");
        echo("neprihlasen nick neni stejny");
        return true;
      }
      else
      {
        if($isAdmin==1)
        {
         $this->mysql->numberOfResults("INSERT INTO `comments` values ('','$text','$nick')");
         echo("prihlasen nick je stejny");
         return true;
        }
        
        else echo("neprihlasen nick je stejny");//return false;
      }
   }

   public function deleteComment ($commentId)

   {

   if(is_int($commentId))
     { 
      $this->mysql->getOneResult("DELETE FROM `comments` WHERE `id`='$articleId'");
      return true;
     }
     else return false;
   }

   public function loadComments ($articleId, $limit = 0)

   {

   // Load comments for given article.

   // Second parameter is limitation

   // - $limit = 10 => load last 10 comments

   // - $limit = 0 => load all comments

   // Check if article with given ID exists.

   }
} 

?>
