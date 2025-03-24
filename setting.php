<?php require "php/functions.php"; ?>
<?php include ("inc/connect.php") ?>

<?php
  $first_name = "";
  $last_name = "";

  session_start();
  if(isset($_SESSION['user_login'])){

  $id = $_SESSION['user_login'];
  $sql="SELECT * FROM users WHERE id = '$id'";

  $result=mysqli_query($con,$sql);

  $row = "";

  if($result)
  {
    $row = mysqli_fetch_assoc($result);
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    if($row["profile_pic"]){
      $profile_pic_url = "user_data/profile_pics/" . $row["profile_pic"];
    }

    else{
      $profile_pic_url = "http://adci.net.au/wp-content/uploads/2014/08/profile-icon.png";
    }
  }

}




?>


<?php
  if(isset($_FILES['profile_pic'])){
    if(($_FILES['profile_pic']["type"]=="image/png") || ($_FILES['profile_pic']["type"]=="image/jpeg")){
      @$chars ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      @$rand_dir_name = substr(str_shuffle($chars), 0, 15);
      mkdir("user_data/profile_pics/$rand_dir_name/");

      move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "user_data/profile_pics/$rand_dir_name/" .$_FILES["profile_pic"]["name"]);

      $profile_pic_name = $_FILES["profile_pic"]["name"];

      $profile_pic_query = mysqli_query($con, "UPDATE users SET profile_pic = '$rand_dir_name/$profile_pic_name' WHERE id = $id");


    }
  }
 ?>
 <html>
 <head>
   <link rel="stylesheet" type="text/css" href="/mhoro/css/profile.css" />
   <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
   <title>Mhoro

   </title>
 </head>
 <body>
   <div class="header_menu">
     <div class="main_nav">

       <div class="main_title">
       <h1>  Mhoro </h1>
       </div>

       <div class="nav">
         <a href="home.php">Home </a>
         <a href="profile.php?u=<?php echo $id; ?>">Profile </a>
         <a href="setting.php">Settings </a>
         <a href="log_out.php">Logout </a>

       </div>
       </div>
     </div>
   </div>
  <div class="content">
    <div class="main_content">

      <div class="left">
        <img src ="<?php echo   $profile_pic_url ?>" width = "95%"/>
        <p><?php echo $first_name . " " . $last_name?></p>
        <br />
        <h3> Settings </h3>
        <br />
        <p> Change your profile picture<br/>
            <a href= "friend_requests.php">friend requests</a>
            
      </div>

      <div class="right">
        <h1> Change your profile picture </h1>

      </div>

      <div class="right2">
        <form action = "" method = "POST" enctype="multipart/form-data">
        <input type="file" name = "profile_pic" />
        <input type = "submit" name = "submit" value=" upload ">
      </form>

      </div>

    </div>
  </div>
