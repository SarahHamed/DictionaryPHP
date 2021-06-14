<?php
  include_once "headerBefore.php";
  ob_start();
?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Register</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Register</li>
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
                    if(isset($_POST["btn"]))
                    {
                        include_once "Users.php";
                        $user= new Users();
                        $dep= new  Departments();
                        $user->setName($_POST["txtname"]);
                        $user->setPassword($_POST["txtpass"]);
                        $user->setPhone($_POST["txtphone"]);
                        $user->setEmail($_POST["txtemail"]);
                        $user->setSpec($_POST["spec"]);
                        $rss=$dep->GetDepartmentID($_POST["spec"]);
                        if($roww=mysqli_fetch_assoc($rss))
                          $user->setdepID($roww['depID']); 
                        $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
                        if(preg_match($reg,$_POST["txtpass"]))
                        {
                        $msg=$user->Add();
                        if($msg=="ok"){
                            echo("<div class='alert alert-success'> your account has been created </div>");
                            echo("<script> window.open('index.php','_self')</script>");
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
              <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                  <input type="text" name="txtname" class="form-control" placeholder="Your Name" required />
                </div>
              </div>
              <div class="row my-2">
                    <div class="col-md-8 form-group m-auto">
                      <input type="email" class="form-control" name="txtemail"  placeholder="Your Email" required />
                    </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="password" class="form-control" name="txtpass"  placeholder="Password" required />
                  </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="text" class="form-control" name="txtphone"  placeholder="Phone" required />
                  </div>
              </div>
              <div class="row my-2">
               <div class="col-md-8 form-group m-auto">
                <select class="form-control text-align-center " name="spec">
                  <option value="NotSelected">--------------------------------------select------------------------------------------</option>
                  <option>Engineering</option>
                  <option>Medicine</option>
                  <option>Law</option>
                  <option>Bussiness</option>
                </select>
               </div>
              </div>
             
              <div class="text-center">
                  <input name="btn" type="submit" value="Register now" class="btn btn-danger"/>
                </div>
            </form>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
	include_once "footer.php";
  ?>