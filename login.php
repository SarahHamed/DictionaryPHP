<?php
  session_start();
  ob_start();
  include_once "headerBefore.php";
  if(isset($_COOKIE['userIdCookie']))
  {
    $_SESSION["id"]=$_COOKIE['userIdCookie'];
    $_SESSION["userName"]=$_COOKIE['userNameCookie'];
    echo("<script> window.open('index.php','_self')</script>");
  }
?>
  
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Login</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Login</li>
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
            <form method="post" class="contact-form">
              <?php
                if(isset($_POST["btnLogin"]))
                {
                  include_once "Users.php";
                  $users=new Users();
                  $users->setEmail($_POST["txtuser"]);
                  $users->setPhone($_POST["txtuser"]);
                  $users->setPassword($_POST["txtpass"]);
                  $rs=$users->Login();
                  if($row=mysqli_fetch_assoc($rs))
                  {
                    $_SESSION["id"]=$row["userId"];
                    $_SESSION["userName"]=$row["name"];
                    if(isset($_POST["chk"]))
                    {
                      setcookie("userIdCookie", $_SESSION["id"], time()+60*60*24*365);
                      setcookie("userNameCookie", $_SESSION["userName"], time()+60*60*24*365);
                    }
                    echo("<script> window.open('index.php','_self')</script>");
                  }
                  else
                  {
                    echo("<div class='alert alert-warning'> Invalid Email/Phone or Password</div>");
                  }
                }
              ?>
              <div class="row">
                <div class="col-md-8 form-group mt-3 mt-md-0 container">
                  <input  class="form-control" name="txtuser" id="email" placeholder="Your Email / Phone"  />
                </div>

                <div class="col-md-8 form-group mt-3 container">
                  <input type="password" name="txtpass" class="form-control" id="name" placeholder="Your Password" />
                </div>
                </div>

                <div class="col-md-8 form-group mt-3 m-auto text-center ">
                  <input type="checkbox" name="chk" class="remember" /><span style="color:gray;"> Remember me </span>
                </div>
                </div>

              <div class="text-center my-2"><input type="submit" value="login" name="btnLogin" class="btn btn-danger"/></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
	include_once "footer.php";
  ?>