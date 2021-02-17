<?php
session_start();
ob_start();
if(isset($_COOKIE['userIdCookie']))
{
  $_SESSION["id"]=$_COOKIE['userIdCookie'];
  $_SESSION["userName"]=$_COOKIE['userNameCookie'];
}

if(isset($_SESSION["id"])){
    include_once "headerAfter.php";}
    ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Articles</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Articles</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">
        <?php 
        include_once "article.php";
        $article= new Articles();
        $rs=$article->GetRandArticle();
        while($row=mysqli_fetch_assoc($rs)){
        ?>
          <div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <article class="entry">

              <div class="entry-img">
                <img style="width:500px; height:230px;"src="<?php echo $row['Image']?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php?id=<?php echo $row['ArticleID']?>"><?php echo $row['articleName']?></a>
              </h2>

              <div class="entry-content">
              <p>
                <?php
                  echo substr($row['articleBody'],0,200);
                  echo("...");
                  ?>   
                </p>
                <div class="read-more">
                  <a href="blog-single.php?id=<?php echo $row['ArticleID']?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          </div>
          <?php 
        }
          include_once "Tables.php";
          
          $word = new Words();
          $rs2=$word->GetLatestwords();
        //  echo("2na hena1");
         // print_r($rs2);
          while($row2=mysqli_fetch_assoc($rs2)){
           // print_r($row2);
            include_once "article.php";
            $articles= new Articles();
           // echo("2na hena2".$row2['word']);
            $var=$row2['word'];
            $rs4=$articles->ArticleSuggestion($var);
           // echo($rs3);
        while($row4=mysqli_fetch_assoc($rs4)){
            
           // print_r($row3);
          //  echo("2na hena3");
            ?>
        <div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <article class="entry">

              <div class="entry-img">
                <img style="width:500px; height:230px;"src="<?php echo $row4['Image']?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.php?id=<?php echo $row4['ArticleID'].'&wordh='.$row2['word']?>"><?php echo $row4['articleName']?></a>
              </h2>

              <div class="entry-content">
                <p>
                <?php
                  echo substr($row4['articleBody'],0,200);
                  echo("...");
                  ?>   
                </p>
                <div class="read-more">
                  <a href="blog-single.php?id=<?php echo $row4['ArticleID'].'&wordh='.$row2['word']?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          </div>
    <?php
        }
          }
        
        ?>

        </div>
<!--
        <div class="blog-pagination" data-aos="fade-up">
          <ul class="justify-content-center">
            <li class="disabled"><i class="icofont-rounded-left"></i></li>
            <li><a href="#">1</a></li>
            <li class="active"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
          </ul>
        </div>
        -->
      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <?php
	include_once "footer.php";
  ?>