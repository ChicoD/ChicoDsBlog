<?php
    
    
    class MySQL
    {
      public  $server;
      public  $username;
      public  $password;
      public  $database;
      public  $result;
      /**
       *   __construct(string $server,string $username,string $password,string $database) Connects to DB
       */
      function __construct($server, $username, $password, $database)
      {
        $this->server=$server;
        $this->username=$username;
        $this->password=$password;
        $this->database=$database;
        $connect=mysql_connect($server,$username,$password)or die("Can`t connect to MySQL: " . mysql_error());       
        $selectDatabase=mysql_select_db("$database")or die("Can`t select DB" . mysql_error());          
      }
      /**
       *  querySend(string $query) Sends query
       */
      protected function querySend($query)
      {
        $querySend=mysql_query("$query")or die("Query error" . mysql_error());
        return $querySend;
      }
      /**
       *  getArrayOfResults(string $query) Gets Array of query results
       */
      public function getArrayOfResults($query)
      { 
        $this->result= $this->querySend($query);
        while( $row = mysql_fetch_assoc($this->result))
        {
          $newArray[] = $row; 
        }
        return $newArray;
      }
      /**
       *  getOneResult(string $query) Gets Array of one query result
       */
      public function getOneResult($query)
      { 
        $this->result= $this->querySend($query);
        $row = mysql_fetch_row($this->result);
        return $row;
      }
      /**
       *  getLastResult(string $query) Gets Array of one last query result
       */
      public function getLastResult($query)
      { 
        $row = mysql_fetch_row($this->result);
        return $row;
      }
      /**
       *  numberOfResults(string $query) Counts number of results
       */
      public function numberOfResults($query)
      { 
        $this->result= $this->querySend($query);
        $rows = mysql_num_rows($this->result);
        return $rows;            
      }
      /**
       *  __destruct() Destructs variables       
       */
      function __destruct()
      { 
        $this->server="";
        $this->username="";
        $this->password="";
        $this->database="";
        $this->result="";
      }   
    }
    
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
     $this->mysqlClass=new Mysql("localhost", "root", "", "mysql_database");
     
     $co="SELECT * FROM articles";
$navrat=mysql_query($co);
echo("<table border=\"1\">");
for ($i=0;$i<mysql_num_fields($navrat); $i++){
echo("<td><strong>".mysql_field_name($navrat, $i)."</strong></td>");
}
while (list($id, $title, $body, $category, $views, $date) = mysql_fetch_row($navrat)){
echo("<tr><td>$id</td><td>$title</td><td>$body</td><td>$category</td><td>$views</td><td>$date</td></tr>");
}
echo("</table>");
  }
  /*
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
    if(is_string($title) && is_string($body) && is_string($category))
    {
      $title=mysql_real_escape_string($title);
      $body=mysql_real_escape_string($body);
      $category=mysql_real_escape_string($category);
      $this->mysqlClass->getOneResult("INSERT INTO `articles` values ('','$title','$body','$category','0',NOW())");
      return true;
    }
    else return false;
  }
  /*
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
    if(is_string($title) && is_string($body) && is_string($category) && is_int($articleId))
    { 
      $title=mysql_real_escape_string($title);
      $body=mysql_real_escape_string($body);
      $category=mysql_real_escape_string($category);
      $control=mysql_query("Select * from `articles` where `id`=$articleId");
      $num_rows = mysql_num_rows($control);
      if($num_rows>0)
      {
        $result=$this->mysqlClass->getOneResult("UPDATE `articles` SET `title` = '$title',`body` = '$body',`category` = '$category',`date`=NOW() WHERE `id` = '$articleId'");
        return true;
      }
      else return false;
    }
  }
  /*
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
  /*
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
      $control=mysql_query("Select * from `articles` where `id`=$articleId");
      $num_rows = mysql_num_rows($control);
      if($num_rows>0)
      {
        $result=$this->mysqlClass->getOneResult("SELECT * FROM articles WHERE `id`='$articleId'");
        $this->increaseViews($articleId);
        return $result;
      }
      else return false;  
    }  
    
  }
  /*
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
       $control=mysql_query("SELECT * FROM `articles` LIMIT $limit");
       $num_rows = mysql_num_rows($control);
       if($num_rows>0)
       {
         $result=$this->mysqlClass->getArrayOfResults("SELECT * FROM `articles` LIMIT $limit");
         return $result;
       }
       else return false;  
    }
    
  } 
  /*
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
  function __destruct()
  { 
    if($this->showArticles(12)){echo("jo");}
    else echo("ne");
    $this->mysqlClass="";
  }   
}     
    
    $articles=new Articles($MySQL);   
?>
