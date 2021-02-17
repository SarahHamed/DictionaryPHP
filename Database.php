<?php
class Database
{
    var $conn;
    function __construct()
    {
        //$this->conn=mysqli_connect("mysql5044.site4now.net","a6729a_ntidb","ABC@123456","db_a6729a_ntidb");
        $this->conn=mysqli_connect("mysql5044.site4now.net","a6d8a1_db","welcomealice!9","db_a6d8a1_db");
    }
  //To Insert- Update - delete 
    function RunDML($statment)
    {
        if(!mysqli_query($this->conn,$statment))
            {
                return  mysqli_error($this->conn);
            }
        else
            return "ok";
    }
    //to search
  function GetData($select)
  {
    $result= mysqli_query($this->conn,$select);
    return $result;
  }

}

?>