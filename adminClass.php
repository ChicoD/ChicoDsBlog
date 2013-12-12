<?php
class Admin
{
  const PASSWORD = '4203db84846e89f3cf8978bf15f9f4c557ad413d80d25d21e40ea1558556acad8e4d5c26a1f55e5552bc5b237b0560cc22e4e34fc6d3532dcb87341e7eb9f173';
 /**
 * _construct()
 *
 * Starts session
 *    
 */
  public function __construct ()
  {
   session_start();
  }
  /**
 * login()
 *
 * Controls password
 *
 * @param string $password 
 * @return boolean 
 */
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
  }
  /**
 * logout()
 *
 * Logouts and destrozs session
 *  
 */
  public function logout ()
  {
   if(isset($_SESSION['loggedIn']))
   {
   session_destroy();
   }
  }
  /**
 * isLogged()
 *
 * Controls if user is logged
 * 
 * @return boolean 
 */
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
  }
} 
?>
