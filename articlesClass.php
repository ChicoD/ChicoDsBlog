<?php
include("index.php");

 class Articles
{
  private $mysqlClass;
  /**
 * _construct
 *
 * connects with Mysql class
 *
 * @param class
 */
  public function __construct(&$MySQL)
  {
     $this->mysqlClass=$MySQL;
  }
  /**
 * addArticle
 *
 * Adds one article
 *
 * @param string $title
 * @param string $body
 * @param string $category  
 */
  public function addArticle($title, $body, $category)
  {
    if($title && $body && $category)
    {
      $title=mysql_real_escape_string($title);
      $body=mysql_real_escape_string($body);
      $category=mysql_real_escape_string($category);
      $this->mysqlClass->getOneResult("INSERT INTO `articles` values ('','$title','$body','$category','0',NOW())");
      return true;
    }
    else return false;
  }
  /**
 * updateArticle
 *
 * Updates one article
 *
 * @param int $articleId
 * @param string $title
 * @param string $body
 * @param string $category  
 */
  public function updateArticle($articleId, $title, $body, $category)
  {
    if($title && $body && $category && is_int($articleId))
    { 
      $title=mysql_real_escape_string($title);
      $body=mysql_real_escape_string($body);
      $category=mysql_real_escape_string($category);
      $num_rows = $this->mysqlClass->numberOfResults("Select * from `articles` where `id`=$articleId");
      if($num_rows>0)
      {
        $result=$this->mysqlClass->getOneResult("UPDATE `articles` SET `title` = '$title',`body` = '$body',`category` = '$category',`date`=NOW() WHERE `id` = '$articleId'");
        return true;
      }
      else return false;
    }
  }
  /**
 * deleteArticle
 *
 * Deletes one article
 *
 * @param int $articleId 
 */
  public function deleteArticle($articleId)
  {
    if(is_int($articleId))
    { 
     $this->mysqlClass->getOneResult("DELETE FROM `articles` WHERE `id`='$articleId'");
     return true;
    }
    else return false;
  }
  /**
 * showArticle
 *
 * Gets one result with article
 *
 * @param int $articleId 
 * @return string 
 */
  public function showArticle($articleId)

  {
    if(is_int($articleId))
    { 
      $num_rows = $this->mysqlClass->numberOfResults("Select * from `articles` where `id`=$articleId");
      if($num_rows>0)
      {
        $result=$this->mysqlClass->getOneResult("SELECT * FROM articles WHERE `id`='$articleId'");
        $this->increaseViews($articleId);
        return $result;
      }
      else return false;  
    }  
    
  }
  /**
 * showArticles
 *
 * Gets limited number of articles
 *
 * @param int $limit
 * @return string  
 */
  public function showArticles($limit)

  {
     if(is_int($limit))
    { 
       $num_rows = $this->mysqlClass->numberOfResults("SELECT * FROM `articles` LIMIT $limit");
       if($num_rows>0)
       {
         $result=$this->mysqlClass->getArrayOfResults("SELECT * FROM `articles` LIMIT $limit");
         return $result;
       }
       else return false;  
    }
    
  } 
  /**
 * increaseViews
 *
 * Increases view of article
 *
 * @param int $articleId 
 */
  private function increaseViews($articleId)
  {
    if(is_int($articleId))
    { 
      $this->mysqlClass->getOneResult("UPDATE `articles` SET `views` = `views`+1 WHERE `id` = '$articleId'");
    }
  }  
}
?>
