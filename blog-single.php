<?php
session_start();

if(isset($_COOKIE['userIdCookie']))
{
  $_SESSION["id"]=$_COOKIE['userIdCookie'];
  $_SESSION["userName"]=$_COOKIE['userNameCookie'];
}

if(isset($_SESSION["id"])){
    include_once "headerAfter.php";}
    ?>

<body>

<main id="main">

  

    <!-- ======= Blog Section ======= -->
    <?php
    include_once "article.php";
    $article= new Articles();
   // $id=2;
    if($_GET['id'])
        $id=$_GET['id'];

    $rs=$article->GetArticle($id);
    if($row=mysqli_fetch_assoc($rs)){
    ?>
      <!-- ======= Breadcrumbs ======= -->
      <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h6> <?php echo $row['articleName']?> </h6>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->
    <section id="blog" class="blog">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="<?php echo $row['Image']?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="blog-single.php"><?php echo $row['articleName']?></a>
                        </h2>

                        <div class="entry-content">
                            <p>
                             <?php
                             if(isset($_GET['wordh']))
                                echo preg_replace("/\w*?".preg_quote($_GET['wordh'])."\w*/i", "<b>$0</b>", $row['articleBody']);
                            else
                            echo ($row['articleBody']);
                              ?>
                            </p>

                        </div>

                    </article>
                    <!-- End blog entry -->
                    <!-- End blog author bio -->

                </div>
                <!-- End blog entries list -->


            </div>

        </div>
    </section>
    <!-- End Blog Section -->
<?php } ?>

</main>
<!-- End #main -->

    <?php
	include_once "footer.php";
  ?>