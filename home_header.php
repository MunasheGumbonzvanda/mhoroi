<?php include ("inc/connect.php") ?>
<?php
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

}
}
  else {
    header("location: index.php");
  }
?>

<?php
  $first_name = "";
  $last_name = "";
  $user_profile= "";
    if(isset($_GET['u']))
    {
      $user_profile = $_GET['u'];

      $sql="SELECT * FROM users WHERE id = '$user_profile'";

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
