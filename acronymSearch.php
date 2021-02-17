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
          <h2>Search Acronym</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Search Acronym</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="row mt-1">

          <div class="col-lg-6">
          </div>
          </div>


          <div class="col-lg-8 mt-5 mt-lg-0 m-auto">
          
                <?php
                    if(isset($_POST["search"]))
                    {
                        $flag=0;
                        include_once "Acronyms.php";
                        // abbID	abbrevWord	definition	depId	userID	video	
                        $acronym= new Acronyms();
                       // echo($_POST["txtsearch"]);
                        $rs=$acronym->showAcronymSearch($_POST["txtsearch"]);
                        while($row=mysqli_fetch_assoc($rs))
                        { 
                            $flag++;
                      ?>
                    <div class="container text-center m-5">
                        <div class="border border-dark  col-md-10">
                      <div class="border border-dark p-2"><b><?php echo $row['abbrevWord']?></b></div>
                      <div class="border border-dark p-2"><b>Definition: </b><?php echo $row['definition']?></div>
                      <div class="border border-dark p-2"><a href="<?php echo $row['video']?>"><?php echo $row['video']?></a></div>
                      <div class="border border-dark p-2">
                      <iframe width="560" height="315" src="<?php  echo (str_replace("watch?v=","embed/",$row['video']))?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                        </div>
                    </div>
                    
                <?php 
                }
                
                if($flag==0)
                    echo("<b>No Results were found</b>");
            }
                else{
                ?>
            <form  method="post" class="contact-form">  
              <div class="row my-2">
                <div class="col-md-8 form-group m-auto ">
                  <input type="text" name="txtsearch" class="form-control" placeholder="Search Acronym" required />
                </div>
              </div>
             
              <div class="text-center">
                  <input name="search" type="submit" value="Search" class="btn btn-danger"/>
                </div>
                <?php }?>
            </form>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
	include_once "footer.php";
  ?>