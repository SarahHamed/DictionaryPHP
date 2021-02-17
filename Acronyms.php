<?php

include_once "Operations.php";
include_once "Database.php";

class Acronyms extends Database implements Operations{
    var $AbbID;
    var $abbrevWord;
    var $definition;
    var $depId;
    var $userID;
    var $video;

    public function getuserID()
    {
        return $this->userID;
    }

    public function setuserID($value)
    {
        $this->userID= $value;
    }
    public function getvideo()
    {
        return $this->video;
    }

    public function setvideo($value)
    {
        $this->video= $value;
    }
    public function getAbbID()
    {
        return $this->AbbID;
    }

    public function setAbbID($value)
    {
        $this->AbbID= $value;
    }

    public function getdefinition()
    {
        return $this->definition;
    }

    public function setdefinition($value)
    {
        $this->definition= $value;
    }

    public function getabbrevWord()
    {
        return $this->abbrevWord;
    }

    public function setabbrevWord($value)
    {
        $this->abbrevWord= $value;
    }
    public function getdepId()
    {
        return $this->depId;
    }

    public function setdepId($value)
    {
        $this->depId= $value;
    }
//abbID	abbrevWord	definition	depId	userID	video
    public function Add()
    {
      $msg= parent::RunDML("insert into `abbreviations` values(Default,'".$this->getabbrevWord()."','".$this->getdefinition()."','".$this->getdepId()."','".$this->getuserID()."','".$this->getvideo()."' )");
      return $msg;
    }
    public function Update()
    {
     /*   $msg=parent::RunDML("update `tableclassification` set Classification='".$this->getclassification()."',noCol='".$this->getnoOfCol()."',headerVlue='".$this->getheaderValue()."' where userId='".$_SESSION["id"]."'");
            return $msg;*/
    }
    public function Delete()
    {
      /*  $msg=parent::RunDML("delete from `tableclassification` where userId='".$_SESSION["id"]."'");
        return $msg;*/
    }
    public function GetAll()
    {

    }
    public function GetUserAcronym($id)
    {
        return parent::GetData("select * from `abbreviations` where  userID='".$id."'");
    }

   /* public function GetDic_ID()
    {
        return parent::GetData("select max(dicId) from `articles` where userId='".$_SESSION['id']."'");
    }
*/
    public function GetRandArticle()
    {
        return parent::GetData("select * from `abbreviations` order by rand() limit 3");
    }
    
    public function showAcronymSearch($search)
    {
        return parent::GetData("select * from `abbreviations` where abbrevWord like '%{$search}%'");        
    }
  
}

?>

