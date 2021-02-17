<?php
session_start();
ob_start();
if(isset($_COOKIE['userIdCookie']))
{
  $_SESSION["id"]=$_COOKIE['userIdCookie'];
  $_SESSION["userName"]=$_COOKIE['userNameCookie'];
}

if(isset($_SESSION["id"])){
    include_once "headerAfter.php";
}
else
header("location:index.php");
    ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Add Acronym</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Add Acronym</li>
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
                    if(isset($_POST["btn2"]))
                    {
                        $_SESSION["acronym"]=$_POST["acronym"];
                        $_SESSION["definition"]=$_POST["definition"];
                       // echo($_SESSION["acronym"]."<br>");
                       // echo($_SESSION["definition"]."<br>");
                       // echo($_POST['spec']."<br>");
                       // echo($_POST['video']."<br>");
                        include_once "Acronyms.php";
                        include_once "Users.php";
                        $dep=new Departments();
// abbID	abbrevWord	definition	depId	userID	video	
                        $acronym= new Acronyms();
                        
                        $acronym->setabbrevWord($_POST["acronym"]);
                        $acronym->setdefinition($_POST["definition"]);
                        echo("I am here");
                        $rs=$dep->GetDepartmentID($_POST['spec']);
                        if($row=mysqli_fetch_assoc($rs))
                        {
                            $acronym->setdepId($row['depID']);  //?????????
                        }
                       
                        $acronym->setuserID($_SESSION["id"]);
                        $acronym->setvideo($_POST["video"]);
                        $msg=$acronym->Add();
                        echo("msg".$msg);

                        header("Location:showAcronyms.php");
                    }

                ?>
                 
                 <?php
                 
                 if(!isset($_POST["btn2"]))
                {
                    include_once "Users.php";
                    $users=new Users();
                    $rs=$users->GetUser();
                    if($row=mysqli_fetch_assoc($rs))
                    {
                        if($row['specialization']!="NotSelected"){
                  ?>
            <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                    <span><b>Acronym:</b></span>
                  <input type="text" name="acronym" class="form-control" placeholder="Abbreviation"  required />
                </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                  <span><b>Definition:</b></span>
                    <input type="text" class="form-control" name="definition"  placeholder="Definition"  required />
                  </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                  <span><b>Resources/Video:</b></span>
                    <input type="text" class="form-control" name="video"  placeholder="Resource's URL"  required />
                  </div>
              </div>
              <div class="row my-2">
                    <div class="col-md-8 form-group m-auto">
                    <span><b>Department:</b></span>
                        <select class="form-control text-align-center " name="spec">
                        <option>--------------------------------------select----------------------------------------</option>
                        <option value="Engineering" <?php if($row["specialization"]=="Engineering") echo("selected"); ?>>Engineering</option>
                        <option value="Medicine" <?php if($row["specialization"]=="Medicine") echo("selected"); ?>>Medicine</option>
                        <option value="Law" <?php if($row["specialization"]=="Law") echo("selected"); ?>>Law</option>
                        <option value="Bussiness" <?php if($row["specialization"]=="Bussiness") echo("selected"); ?>>Bussiness</option>
                        </select>
                    </div>
                    </div>
              <div class="text-center">
                  <input name="btn2" type="submit" value="ADD" class="btn btn-danger"/>
                </div>
            <?php }
            else{
                echo("<div class='conatiner text-center'><h4>You are not authorized to Access this page</h4></div>");
            }
            }
            
                }
            ?>
            </form>


        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
	include_once "footer.php";
  ?>
