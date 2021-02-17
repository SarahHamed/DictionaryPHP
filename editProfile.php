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
    ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Edit Profile</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Edit Profile</li>
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
          <form  method="post" class="contact-form" enctype="multipart/form-data">
                <?php
                    if(isset($_POST["btn"]))
                    {
                        include_once "Users.php";
                        $user= new Users();
                        $user->setName($_POST["txtname"]);
                        $user->setPassword($_POST["txtpass"]);
                        $user->setPhone($_POST["txtphone"]);
                        $user->setEmail($_POST["txtemail"]);
                        $user->setSpec($_POST["spec"]);
                        $user->setdepID($_SESSION["depID"]);
                        $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
                        echo("here3".$_POST["txtpass"]);
                        if(preg_match($reg,$_POST["txtpass"]))
                        {
                        $msg=$user->Update();
                        
                        if($msg=="ok"){
                          $dir="Users/";
                            $image=$_FILES['file']['name'];     
                            $temp_name=$_FILES['file']['tmp_name'];
                            
                            //$size = filesize($temp_name);
                            //echo($size);

                            $img=$_SESSION["id"];
                            if($image!="")
                            {
                                $fdir= $dir.$img.".jpg";
                                move_uploaded_file($temp_name, $fdir);
                            }
                            $_SESSION["name"]=$_POST["txtname"];
                            //echo("<div class='alert alert-success'> your account has been created </div>");
                            header("location:myprofile.php");
                        }
                        else if(strpos($msg, "users.Email"))
                            echo("<div class='alert alert-danger'>Sorry this Email is used</div>");
                        else if(strpos($msg, "users.Phone"))
                            echo("<div class='alert alert-danger'>Sorry this Phone is used</div>");
                        else 
                            echo("<div class='alert alert-danger'>$msg</div>");
                        }
                        else{
                          echo("<div class='alert alert-warning'>This password is weak , Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character </div>");
                        }
                    }
                ?>
                 <?php
                 if(isset($_SESSION["id"]))
                {
                  include_once "Users.php";
                  $users=new Users();
                  $rs=$users->GetUser();
                  if($row=mysqli_fetch_assoc($rs))
                  {
                    $_SESSION['depID']=$row['depID'];
                      ?>
              <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                  <input type="text" name="txtname" class="form-control" placeholder="Your Name" value="<?php echo($row['name']); ?>" required />
                </div>
              </div>
              <div class="row my-2">
                    <div class="col-md-8 form-group m-auto">
                      <input type="email" class="form-control" name="txtemail"  placeholder="Your Email" value="<?php echo($row['email']); ?>" required />
                    </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="password" class="form-control" name="txtpass"  placeholder="Password" value="<?php echo($row['password']); ?>" required />
                  </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="text" class="form-control" name="txtphone"  placeholder="Phone" value="<?php echo($row['phone']); ?>" required />
                  </div>
              </div>
              <div class="row my-2">
               <div class="col-md-8 form-group m-auto">
                <select class="form-control text-align-center " name="spec">
                  <option value="NotSelected">--------------------------------------select----------------------------------------</option>
                  <option value="Engineering" <?php if($row["specialization"]=="Engineering") echo("selected"); ?>>Engineering</option>
                  <option value="Medicine" <?php if($row["specialization"]=="Medicine") echo("selected"); ?>>Medicine</option>
                  <option value="Law" <?php if($row["specialization"]=="Law") echo("selected"); ?>>Law</option>
                  <option value="Bussiness" <?php if($row["specialization"]=="Bussiness") echo("selected"); ?>>Bussiness</option>
                </select>
               </div>
              </div>
              <div class="row my-2">
              <div class="col-md-8 form-group m-auto">
                 <b> Image:</b> <input name="file" type="file" class=""/>
              </div>
              </div>
                <div class="text-center">
                  <input name="btn" type="submit" value="Update" class="btn btn-danger"/>
                </div>
            <?php } 
            else{
                header("location:index.php");
            }

            
        }}
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
