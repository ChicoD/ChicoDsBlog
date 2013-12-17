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
      
?>
