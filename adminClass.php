<?php
class Admin
{
  const PASSWORD = '4203db84846e89f3cf8978bf15f9f4c557ad413d80d25d21e40ea1558556acad8e4d5c26a1f55e5552bc5b237b0560cc22e4e34fc6d3532dcb87341e7eb9f173';
  public function __construct ()
  {
   session_start();
  }

  public function login ($password)
  {
    if(isset($password))
    {
      $password=stripslashes($password);
      $password = hash('sha512',$password.'ronaldinho');
      $password = mysql_real_escape_string($password);
      if($password==self::PASSWORD)
      {
        $_SESSION['loggedIn']=1;
        return true;
      }              
      else return false;
    }
    else return false;
  // Check if given password is correct and return true on success

  // (and save it into $_SESSION) or false if wrong password

  // is given.
  }
  public function logout ()
  {
   if(isset($_SESSION['loggedIn']))
   {
   session_destroy();
   }
  // Logout admin - just remove it from $_SESSION
  }

  public function isLogged ()

  {
    if(isset($_SESSION['loggedIn']))
    {        
      if($_SESSION['loggedIn']==1)
      {
       return true;
      }
      else return false;
    }
    else return false;
  // Return, if current user is logged as admin or not.

  // This will be used later in admin section or when

  // you will try to, let's say, delete comments.

  }

} 

$admin=new Admin();
$result=$admin->isLogged();
echo("$result");

?>
