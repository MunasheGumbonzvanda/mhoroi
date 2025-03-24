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
      </div>

      <div class="right">
        <h1> Friend Requests </h1>

      </div>

      <div class="right2">

        <?php
           $friend_query = mysqli_query($con, "SELECT * FROM friend_requests WHERE user_to = '$id'");
           $friend_rows = mysqli_num_rows($friend_query);
           if($friend_rows == 0)
           {
             echo "error";
           }

           else{
             while( $friend_rows_usable = mysqli_fetch_assoc($friend_query))
             {
               @$id = $friend_rows_usable["id"];
               @$user_from = $friend_rows_usable["user_from"];
               @$user_to = $friend_rows_usable['user_to'];
               echo $user_to ." wants to be friends" ;

             }
           }
           ?>
           <?php
             if(isset($_POST["accept" . $user_from ]))
             {
                echo "friend request accepted";

                $friend_array = mysqli_query($con, "SELECT * FROM users WHERE id = '$user_to'");
                $friend_array_usable = mysqli_fetch_assoc($friend_array);
                $user_array = $friend_array_usable['friend_array'];
                $friend_array_explode = explode(",", $user_array);
                $friend_array_count = count($friend_array_explode);

                $friend_array_from = mysqli_query($con, "SELECT * FROM users WHERE id = '$user_from'");
                $friend_array_usable_from = mysqli_fetch_assoc($friend_array_from);
                $user_array_from = $friend_array_usable_from['friend_array'];
                $friend_array_explode_from = explode(",", $user_array_from);
                $friend_array_count_from = count($friend_array_explode_from);

                if($user_array=="")
                {
                  $friend_array_count = count(NULL);
                }

                if($user_array_from== "")
                {
                  $friend_array_count_from = count(NULL);
                }

                if($friend_array_count == NULL)
                {

                  $query = mysqli_query($con, "UPDATE users SET friend_array= CONCAT(friend_array,'$user_from') WHERE id = '$user_to'");
                }

                if($friend_array_count_from == NULL)
                {
                  echo $user_to;
                  $query = mysqli_query($con, "UPDATE users SET friend_array= CONCAT(friend_array,'$user_to') WHERE id = '$user_from'");
                }
             }
            ?>
           <form action = "" method = "POST">
             <input type = "submit" name = "accept<?php echo $user_from ?>" value = " accept request " />
             <input type = "submit" name = "reject<?php echo $user_from ?>" value = " reject " />
           </form>
      </div>

    </div>
  </div>
