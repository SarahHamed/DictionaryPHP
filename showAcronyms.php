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
          <h2>Show My Acronyms</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Show My Acronyms</li>
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
                 <?php
                 $flag=0;
                include_once "Acronyms.php";
                    $acronym=new Acronyms();
                    $_rs=$acronym->GetUserAcronym($_SESSION['id']);
                    ?>
                        <table class="table table-striped table-bordered text-center"> 
                            <tr class="table-dark">
                            <th>Acronym</th> 
                            <th>Definition</th>
                            <th>Resource</th>
                            </tr>
                    <?php 
                    while($row=mysqli_fetch_assoc($_rs))
                    {
                  ?>

                  <td><b><?php echo $row['abbrevWord']?></b></td>
                  <td><?php echo $row['definition']?></td>
                  <td><a href="<?php echo $row['video']?>"><?php echo $row['video']?></a></td>
                  </tr>
                    <?php 
                    }
                    ?>
            </table>
            <div class="text-center">
                  <a href="AcronymAdmin.php" class="btn btn-dark"> ADD Acronym </a>
            </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
	include_once "footer.php";
  ?>
