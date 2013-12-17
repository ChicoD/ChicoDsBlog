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

   // Check if article with given ID eixsts.

   // Check if text is not empty and escape it against HTML characters.

   // Remember that admin nick can be used only if admin is logged.

   // Also note that "ChicoD" != "ChicoD " != " ChicoD"

   // (maybe trim() will help you here...)

   }

   public function deleteComment ($commentId)

   {

   // Just delete comment, no big deal...

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
