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
          <h2>Create Table</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Create Table </li>
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
                        $_SESSION["tname"]=$_POST["tname"];
                        $_SESSION["col"]=$_POST["noCol"];
                        echo($_SESSION["tname"]);
                        echo($_SESSION["col"]);
                        
                    for($i=0;$i<$_SESSION["col"];$i++){
                        ?>
                    
                    <div class="row my-2">
                            <div class="col-md-8 form-group m-auto">
                            <input type="text" class="form-control" name='key<?php echo($i) ?>'  placeholder="header key" value="" required />
                            </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-8 form-group m-auto">
                            <input type="text" class="form-control" name='value<?php echo($i) ?>'  placeholder="value" value="" required />
                        </div>
                    </div>

                        <?php
                    
                        }
                        ?>

                        <div class="text-center">
                        <input name="btn3" type="submit" value="Add" class="btn btn-danger"/>
                        </div>
                <?php

                    }
                ?>
                    <?php
                    if(isset($_POST["btn3"]))
                    {
                        include_once "Tables.php";
                        $table= new Tables();
                        $table->setclassification($_SESSION["tname"]);
                        $table->setnoOfCol($_SESSION["col"]);
                        $table->setuserId($_SESSION['id']);
                        $msg=$table->Add();
                        
                        $table2= new Tables();
                        $rss=$table2->GetDic_ID();
                       if($roww=mysqli_fetch_assoc($rss)) {

                    for($i=0;$i<$_SESSION["col"];$i++){
                        $header= new Header();
                        $header->setheaderKey($_POST["key{$i}"]);
                        $header->setheaderValue($_POST["value{$i}"]);
                     
                        $msg=$header->setdicId($roww['max(dicId)']);   
                        $msg=$header->Add();
                       }
                        }
                        header("Location:wordEntry.php");
 
                    }
                ?>
                 
                 <?php
                 
                 if(!isset($_POST["btn2"]))
                {
                  include_once "Tables.php";
                  $table=new Tables();
                //  $rs=$table->GetTable();
                  if($row=mysqli_fetch_assoc($rs))
                  {
                      ?>
              <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                  <input type="text" name="tname" class="form-control" placeholder="Table Name" value="<?php /*echo($row['Classification']); */?>" required />
                </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="text" class="form-control" name="noCol"  placeholder="number of columns" value="<?php /* echo($_SESSION['col']); */?>" required />
                  </div>
              </div>


                <div class="text-center">
                  <input name="btn2" type="submit" value="Add Dectionary" class="btn btn-danger"/>
                </div>
            <?php } else
            {?>
            <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                  <input type="text" name="tname" class="form-control" placeholder="Table Name"  required />
                </div>
              </div>
              <div class="row my-2">
                  <div class="col-md-8 form-group m-auto">
                    <input type="text" class="form-control" name="noCol"  placeholder="number of columns"  required />
                  </div>
              </div>
              <div class="text-center">
                  <input name="btn2" type="submit" value="Update" class="btn btn-danger"/>
                </div>
            <?php }
            
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
