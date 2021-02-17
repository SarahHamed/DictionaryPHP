<?php
ob_start();
session_start();

if(isset($_COOKIE['userIdCookie']))
{
  $_SESSION["id"]=$_COOKIE['userIdCookie'];
  $_SESSION["userName"]=$_COOKIE['userNameCookie'];
}

if(isset($_SESSION["id"])){
    include_once "headerAfter.php";
    ?>
<?php
}
else
    {include_once "headerBefore.php";
    header("Location:index.php");
    }
?>
  <main id="main">

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Tables</h2>
      <ol>
        <li><a href="index.php">Home</a></li>
        <li> Tables</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div class="container">
    <div class="row mt-1">
      <div class="col-lg-4">
        </div>
      </div>
      <div class="col-lg-8 mt-5 mt-lg-0 m-auto">
      <form  method="post" class="contact-form">
        
           <?php
           
            include_once "Tables.php";
            $table=new Tables();
            $rs=$table->GetTable();
            if($row=mysqli_fetch_assoc($rs))
            {?>
              <center>  <h4><b> <?php echo $row["Classification"]?></h4></b> </center>
                <table class="table table-striped mt-2">
                  <tr>
              <?php if(isset($_GET['wordID'])){?>
                <th>  <?php echo ($_SESSION["hkey"]);?></b></td> <td> <b> <?php echo ($_SESSION["hvalue"]);?></th> <th>Edit | Delete</th>
            </tr>
              <?php } else if(isset($_GET["hkey"])){
                $_SESSION["hkey"]=$_GET["hkey"];
                $_SESSION["hvalue"]=$_GET["hvalue"];
                $_SESSION["header"]=$_GET["header"];
                ?>
            <th>  <?php echo ($_GET["hkey"]);?></b></td> <td> <b> <?php echo ($_GET["hvalue"]);?></th> <th>Edit | Delete</th>
            </tr>
              <?php }?>
            <?php
             $word= new Words();
    
             $rs2=$word->Getwords($_SESSION['header']);
             while($row2=mysqli_fetch_assoc($rs2)){
              if(isset($_GET['wordID'])) 
                {
                  if($row2['wordID']==$_GET['wordID']){
                    if($_GET['op']=="edit"){
                    $_SESSION['word']=$row2['word'];
                    $_SESSION['meaning']=$row2['meaning'];
                    $_SESSION['headerID']=$row2['headerID'];
                    $_SESSION['wordID']=$row2['wordID'];
                  //  echo('here in session');
                    ?>
                    
                    <tr>                                                                           
                  <td>  <input name='word' value='<?php echo($row2['word'])?>'/></td> 
                  <td> <input name='meaning' value='<?php echo($row2['meaning']) ?>'/></td> 
                  <td><input type="submit" value='update' name='word-update'></td>
                   </tr>
                    </form>
                <?php  }
                else if($_GET['op']=="delete")
                {
                 // echo("i am in headerID=".$_SESSION['headerID']."word=".$_POST['word']);
                    $word = new Words();
                    $word->setword($row2['word']);
                    $word->setwordID($row2['wordID']);
                    $word->setmeaning($row2['meaning']);
                    $word->setheaderID($row2['headerID']);
                    $word->setuser($_SESSION['id']);
                    $msg=$word->Delete();
                    echo($msg);
                    $path="header=".$_SESSION['header']."&hkey=".$_SESSION['hkey']."&hvalue=".$_SESSION['hvalue'];
                    echo($path);
                   header("Location:showtables.php?$path");
                 /*   $path="header=".$_SESSION['headerID']."&hkey=".$_SESSION['hkey']."&hvalue=".$_SESSION['hvalue'];
                    echo($path);
                   header("Location:showtables.php?$path");*/
                }
                }
                else{?>
                <tr>
                     <td> <?php echo($row2['word']) ?></td> 
                     <td> <?php echo($row2['meaning']) ?></td> 
                     <td><a  href='?wordID=<?php echo($row2["wordID"])?>&op=edit'>edit</a> <a  href='?wordID=<?php echo($row2["wordID"])?>&op=delete'>delete</a> </td>
                </tr>
               <?php }
                }
              else{
               ?>   
             <tr>                                                                           
              <td> <?php echo($row2['word']) ?></td> <td> <?php echo($row2['meaning']) ?></td> 
              <td><a  href='showtables.php?wordID=<?php echo($row2["wordID"])?>&op=edit'>edit</a> | <a  href='?wordID=<?php echo($row2["wordID"])?>&op=delete'>delete</a> </td>
             </tr>
              <?php
            }}}
            ?>
            </table>
             <!--   Eneter new word -->
             <?php
             if(!isset($_GET['wordID'])){ ?>
             <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                  <input type="text" name="word" class="form-control" placeholder="Add new word" value="" required />
                </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="text" class="form-control" name="meaning"  placeholder="description/meaning" value="" required />
                  </div>
              </div>
                <div class="text-center">
                  <input name="btn-add-word" type="submit" value="Add to Dictionary" class="btn btn-danger"/>
                </div>
             <?php }?>
                <?php 
                  if(isset($_POST['btn-add-word']))
                  {
                    $word = new Words();
                    $word->setword($_POST['word']);
                    $word->setmeaning($_POST['meaning']);
                    $word->setheaderID($_GET['header']);
                    $word->setuser($_SESSION['id']);
                    $msg=$word->Add();
                    $path="header=".$_GET['header']."&hkey=".$_SESSION['hkey']."&hvalue=".$_SESSION['hvalue'];
                    echo($path);
                   header("Location:showtables.php?$path");
                  }
                  if(isset($_POST['word-update']))
                  { echo("i am in headerID=".$_SESSION['headerID']."word=".$_POST['word']);
                    $word = new Words();
                    $word->setword($_POST['word']);
                    $word->setmeaning($_POST['meaning']);
                    $word->setheaderID($_SESSION['headerID']);
                    $word->setuser($_SESSION['id']);
                    $word->setwordID($_SESSION['wordID']);
                    $msg=$word->Update();
                    echo($msg);
                    $path="header=".$_SESSION['headerID']."&hkey=".$_SESSION['hkey']."&hvalue=".$_SESSION['hvalue'];
                    echo($path);
                   header("Location:showtables.php?$path");
                  }
                  
                ?>
        </form>
    </div>

  </div>
</section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
	include_once "footer.php";
  ?>