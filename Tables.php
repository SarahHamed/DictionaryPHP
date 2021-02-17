<?php
include_once "Operations.php";
include_once "Database.php";
//classification
class Tables extends Database implements Operations{
    var $dicId;
    var $classification;
    var $userId;
    var $noOfCol;

    public function getdicId()
    {
        return $this->dicId;
    }

    public function setdicId($value)
    {
        $this->dicId= $value;
    }

    public function getclassification()
    {
        return $this->classification;
    }

    public function setclassification($value)
    {
        $this->classification= $value;
    }

    public function getnoOfCol()
    {
        return $this->noOfCol;
    }

    public function setnoOfCol($value)
    {
        $this->noOfCol= $value;
    }
    public function getuserId()
    {
        return $this->userId;
    }

    public function setuserId($value)
    {
        $this->userId= $value;
    }

    public function Add()
    {
      $msg= parent::RunDML("insert into `tableclassification` values(Default,'".$this->getclassification()."','".$this->getuserId()."','".$this->getnoOfCol()."')");
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
    public function GetTable()
    {
        return parent::GetData("select * from `tableclassification` where userId='".$_SESSION['id']."' ");
    }

    public function GetDic_ID()
    {
        return parent::GetData("select max(dicId) from `tableclassification` where userId='".$_SESSION['id']."'");
    }

}

/*******************************************************************************/
class Header extends Database implements Operations{
    var $headerKey;
    var $headerValue;
    var $dicID;
    var $headerID;

    public function getheaderID()
    {
        return $this->headerID;
    }
    public function setheaderID($value)
    {
        $this->headerID= $value;
    }
    public function getdicId()
    {
        return $this->dicID;
    }

    public function setdicId($value)
    {
        $this->dicID= $value;
    }

    public function getheaderKey()
    {
        return $this->headerKey;
    }

    public function setheaderKey($value)
    {
        $this->headerKey= $value;
    }
    public function getheaderValue()
    {
        return $this->headerValue;
    }

    public function setheaderValue($value)
    {
        $this->headerValue= $value;
    }


//    headID	key	value	dicID	wordID 
    public function Add()
    {
      $msg= parent::RunDML("insert into `headers` values(Default,'".$this->getheaderKey()."','".$this->getheaderValue()."','".$this->getdicId()."')");
        return $msg;
    }
    public function Update()
    {
/*        $msg=parent::RunDML("update `headers` set key='".$this->getheaderKey()."',value='".$this->getheaderValue()."',headerVlue='".$this->getheaderValue()."' where userId='".$value."'");
            return $msg;
            */
    }
    
    public function Delete()
    {
       /* $msg=parent::RunDML("delete from `headers` where userId='".$_SESSION["id"]."'");
        return $msg;*/
    }
    public function GetAll()
    {

    }
    public function GetTable($value)
    {
        return parent::GetData("select * from `headers` where dicID='".$value."'");
    }

}


/*******************************************************************************/
class Words extends Database implements Operations{
    var $wordID;
    var $word;
    var $meaning;
    var $date;
    var $headerID;
    var $userid;    

    public function getuser()
    {
        return $this->userid;
    }

    public function setuser($value)
    {
        $this->userid= $value;
    }

    public function getheaderID()
    {
        return $this->headerID;
    }
    public function setheaderID($value)
    {
        $this->headerID= $value;
    }
    public function getwordID()
    {
        return $this->wordID;
    }
    public function setwordID($value)
    {
        $this->wordID= $value;
    }
    public function getword()
    {
        return $this->word;
    }

    public function setword($value)
    {
        $this->word= $value;
    }

    public function getmeaning()
    {
        return $this->meaning;
    }

    public function setmeaning($value)
    {
        $this->meaning= $value;
    }
    public function getdate()
    {
        return $this->date;
    }

    public function setdate($value)
    {
        $this->date= $value;
    }

    public function Add()
    {
      $msg= parent::RunDML("insert into `Words` values(Default,'".$this->getword()."','".$this->getmeaning()."',Now(),'".$this->getheaderID()."','".$this->getuser()."')");
        return $msg;
    }
    public function Update()
    {
        $msg=parent::RunDML("update `Words` set word='".$this->getword()."',meaning='".$this->getmeaning()."',date=Now(),headerID='".$this->getheaderID()."' where wordID='".$this->getwordID()."'");
            return $msg;       
    }
    public function Delete()
    {
       /* $msg=parent::RunDML("delete from `headers` where userId='".$_SESSION["id"]."'");
        return $msg;*/
        $msg=parent::RunDML("delete from `Words` where word='".$this->getword()."' and wordID='".$this->getwordID()."'");
            return $msg;
    }
    public function GetAll()
    {

    }
 /*   public function GetTable($value)
    {
        return parent::GetData("select * from `Words` where wordID='".$value."'");
    }
*/
public function Getwords($value)
{
    return parent::GetData("select * from `words` where headerID='".$value."'");
}

public function GetLatestwords()
{
    return parent::GetData("select * from `words` where userid='".$_SESSION['id']."' order by wordID DESC  limit 3");
}
/*
public function mostRepeatedWord()
{
    //return parent::GetData(("SELECT word COUNT(*) AS magnitude FROM `words` WHERE YEARWEEK(date) = YEARWEEK(NOW()) GROUP BY word ORDER BY magnitude DESC LIMIT 1"));
    return parent::GetData(("SELECT *FROM yourTableName WHERE YEARWEEK(yourDateColumnName) = YEARWEEK(NOW());"));
}
*/
/* select column, COUNT(*) AS magnitude 
FROM table 
GROUP BY column 
ORDER BY magnitude DESC
LIMIT 1
*/
//SELECT *FROM yourTableName WHERE YEARWEEK(yourDateColumnName) = YEARWEEK(NOW());

}
?>