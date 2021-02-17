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
                while($row=mysqli_fetch_assoc($rs))
                {?>
                    <h4 class="mt-3"> <?php echo $row["Classification"];?></h4>
             <?php   
             $header= new Header();
             $header->setdicId($row["dicId"]);   
             $rs2=$header->GetTable($header->getdicId());
             while($row2=mysqli_fetch_assoc($rs2))
                {?>

                <li>   <a href="showtables.php?header=<?php echo($row2["headID"]."&hkey=".$row2["key"]."&hvalue=".$row2["value"])?>"><?php echo ($row2["key"]);?></a> </li>
                <?php }} ?>
            </form>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
	include_once "footer.php";
  ?>
