<?php

include_once "Operations.php";
include_once "Database.php";
//classification
class Articles extends Database implements Operations{
    var $ArticleID;
    var $articleName;
    var $articleBody;
    var $image;

    public function getArticleID()
    {
        return $this->ArticleID;
    }

    public function setArticleID($value)
    {
        $this->ArticleID= $value;
    }

    public function getarticleName()
    {
        return $this->articleName;
    }

    public function setarticleName($value)
    {
        $this->articleName= $value;
    }

    public function getarticleBody()
    {
        return $this->noOfCol;
    }

    public function setarticleBody($value)
    {
        $this->noOfCol= $value;
    }
    public function getimage()
    {
        return $this->image;
    }

    public function setimage($value)
    {
        $this->image= $value;
    }

    public function Add()
    {
      $msg= parent::RunDML("insert into `articles` values(Default,'".$this->getarticleName()."','".$this->getarticleBody()."','".$this->getimage()."')");
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
    public function GetArticle($id)
    {
        return parent::GetData("select * from `articles` where  ArticleID='".$id."' ");
    }

   /* public function GetDic_ID()
    {
        return parent::GetData("select max(dicId) from `articles` where userId='".$_SESSION['id']."'");
    }
*/
    public function GetRandArticle()
        {
            return parent::GetData("select * from `articles`  order by rand() limit 3");
        }
    public function ArticleSuggestion($word)
    {
        return parent::GetData("select * from `articles` where articleBody like '%{$word}%'");
  //  return parent::GetData("select * from `articles` ");
        
    }
  

}

/* 
SELECT * FROM table_name
ORDER BY RAND()
LIMIT 1;
*/
?>

