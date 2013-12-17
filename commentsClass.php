<?php
 
 class Comments
 {
   private $mysql;

   private $adminNick;
   /**
 *
 * connects to mysql database and saves nick of admin
 *
 * @param class &$MySQL
 * @param string $adminNick 
 */
   public function __construct (&$MySQL, $adminNick)
   {
    $this->mysql=$MySQL;
    $this->adminNick=$adminNick;
   }
 /**
 *
 * adds one comment
 *
 * @param int $articleId
 * @param string $text
 * @param string $nick
 * @param boolean $isAdmin  
 * @return boolean
 */
   public function addComment ($articleId, $text, $nick, $isAdmin)
   {
      $num_rows = $this->mysql->numberOfResults("Select * from `articles` where `id`=$articleId");
      if($text && $num_rows>0 && $nick && is_int($articleId) && is_bool($isAdmin))
      {
        $text=htmlspecialchars($text);
        $nick=ltrim($nick);
        $nick=rtrim($nick);  
      }
      else return false;       
      if($nick!=$this->adminNick)
      {
        $this->mysql->numberOfResults("INSERT INTO `comments` values ('','$text','$nick','$articleId')");
        return true;
      }
      else
      {
        if($isAdmin==1)
        {
         $this->mysql->numberOfResults("INSERT INTO `comments` values ('','$text','$nick','$articleId')");
         return true;
        }
        return false;
      }
   }
/**
 *
 * deletes one comment
 *
 * @param int $commentId 
 * @return boolean
 */
   public function deleteComment ($commentId)
   {
   if(is_int($commentId))
     { 
      $this->mysql->getOneResult("DELETE FROM `comments` WHERE `id`='$articleId'");
      return true;
     }
     else return false;
   }
 /**
 *
 * shows limited number of comments
 *
 * @param int $articleId
 * @param int $limit 
 * return array $result
 */
   public function loadComments ($articleId, $limit = 0)
   {
      $num_rows = $this->mysql->numberOfResults("Select * from `articles` where `id`=$articleId");
      if($num_rows>0 && is_int($limit) && $limit>=0)
      {
        if($limit==0)
        {
         $result=$this->mysql->numberOfResults("Select * from `comments` where `articleId`=$articleId ORDER BY id DESC");
         return $result;
        }
        else {
        $result=$this->mysql->numberOfResults("Select * from `comments` where `articleId`=$articleId ORDER BY id DESC LIMIT $limit");
        return $result;
        }   
      }
      else return false;
   }
} 
?>
