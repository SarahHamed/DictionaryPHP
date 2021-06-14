<?php
session_start();

if(isset($_COOKIE['userIdCookie']))
{
  $_SESSION["id"]=$_COOKIE['userIdCookie'];
  $_SESSION["userName"]=$_COOKIE['userNameCookie'];
}

if(isset($_SESSION["id"])){
    include_once "headerAfter.php";
    ?>
    <!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>My Profile</h2>
      <ol>
        <li><a href="index.php">My Profile</a></li>
        <li>My Profile</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs -->
<?php
}
else
    {include_once "headerBefore.php";}
?>

<section class="container w-50 text-center">
    <table class="table ">
        <?php
        if(isset($_SESSION["id"]))
        {
            include_once "Users.php";
            $dep= new Departments;
            $user = new Users;
            
            $rs=$user->GetUser();
         /*   $rs5=$dep->GetDepartmentID($rows["specialization"]);
                if($row5=mysqli_fetch_assoc($rs5))
                  {
                    $user->setdepID($row['depID']);  //?????????
                  }*/
            if($rows = mysqli_fetch_assoc(($rs)))
            {  ?>
            <div class="mb-3" >
             <img src="Users/<?php echo($_SESSION["id"]);?>.jpg" class="rounded-circle" width="150px" height="150px"/>
            </div>
            <tr class="border border-dark rounded bg-dark" style="color:white">
                <td > Full Name</td>
                <td class="text-center"><?php echo($rows["name"]);?></td>
            </tr>
            <tr class="border border-dark rounded bg-light">
                <td> Email</td>
                <td class="text-center"><?php echo($rows["email"]);?></td>
            </tr>
            <tr class="border border-dark rounded bg-dark" style="color:white">
                <td > Phone</td>
                <td class="text-center"><?php echo($rows["phone"]);?></td>
            </tr>
            <tr class="border border-dark rounded bg-loght">
                <td> Specialization</td>
                <td class="text-center"><?php echo($rows["specialization"]);?></td>
            </tr>
            

<?php
            }
            else
            {
                header("Location:index.php");
            }
        }
        ?>
    </table>
        <div class="d-flex justify-content-center">
                <div class="m-1">
                <a href="editProfile.php" class="btn btn-dark"> Edit Acoount</a>
                </div>
                <div class="m-1">
                <a href="delete.php" class="btn btn-secondary"> Delete Acoount</a>
                </div>
                <div class="m-1">
                <a href="createTable.php" class="btn btn-dark"> Create Table</a>
                </div>
                <div class="m-1">
                <a href="wordEntry.php" class="btn btn-secondary"> Show my Tables</a>
                </div>
                </div>
    </section>

<?php
	include_once "footer.php";
  ?>