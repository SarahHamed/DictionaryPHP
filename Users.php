<?php
include_once "Operations.php";
include_once "Database.php";

class Users extends Database implements Operations{
    var $userId;
    var $name;
    var $spec;
    var $password;
    var $email;
    var $phone;
    var $depID;

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($value)
    {
        $this->userId= $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name= $value;
    }

    public function getSpec()
    {
        return $this->spec;
    }

    public function setSpec($value)
    {
        $this->spec= $value;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password= $value;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email= $value;
    }
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($value)
    {
        $this->phone= $value;
    }
    public function getdepID()
    {
        return $this->depID;
    }

    public function setdepID($value)
    {
        $this->depID= $value;
    }

    public function Add()
    {
      $msg= parent::RunDML("insert into `myusers` values(Default,'".$this->getPassword()."','".$this->getName()."','".$this->getEmail()."','".$this->getPhone()."','".$this->getSpec()."',NULL,'".$this->getdepID()."')");
      //  $msg= parent::RunDML("insert into `users` values(Default,'".$this->getName()."','".$this->getEmail()."','".$this->getPhone()."','".$this->getCountry()."')");       
        return $msg;
    }
    public function Update()
    {
        $msg=parent::RunDML("update `myusers` set name='".$this->getname()."',password='".$this->getpassword()."',email='".$this->getemail()."',phone='".$this->getphone()."',specialization='".$this->getSpec()."',dicId=NULL,depId='".$this->getdepID()."' where userid='".$_SESSION["id"]."'");
            return $msg;
    }
    public function Delete()
    {
        $msg=parent::RunDML("delete from `myusers` where userid='".$_SESSION["id"]."'");
        return $msg;
    }
    public function GetAll()
    {

    }
    public function GetUser()
    {
        return parent::GetData("select * from `myusers` where UserID='".$_SESSION["id"]."'");
    }
    public function Login()
    {
        return parent::GetData("select * from `myusers` where (phone='".$this->getPhone()."' Or Email='".$this->getEmail()."') and password='".$this->getPassword()."'");
    }

}


class Departments extends Database implements Operations{
    var $depID;
    var $depName;
    		
    public function getdepID()
    {
        return $this->depID;
    }

    public function setdepID($value)
    {
        $this->depID= $value;
    }

    public function getdepName()
    {
        return $this->depName;
    }

    public function setdepName($value)
    {
        $this->depName= $value;
    }

    public function Add()
    {
      $msg= parent::RunDML("insert into `departments` values(Default,'".$this->getdepName()."'");
      //  $msg= parent::RunDML("insert into `users` values(Default,'".$this->getName()."','".$this->getEmail()."','".$this->getPhone()."','".$this->getCountry()."')");       
        return $msg;
    }
    public function Update()
    {
        $msg=parent::RunDML("update `departments` set userName='".$this->getdepName()."'");
            return $msg;
    }
    public function Delete()
    {
     /*   $msg=parent::RunDML("delete from `departments` where userid='".$_SESSION["id"]."'");
        return $msg;
        */
    }
    public function GetAll()
    {

    }
    public function GetDepartmentID($value)
    {
        return parent::GetData("select * from `departments` where depName='".$value."'");
    }
   

}

?>