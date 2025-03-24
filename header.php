<?php include ("connect.php") ?>

<?php
session_start();
if(!isset($_SESSION["user_login"]))
{

}

else {
  header("location: home.php");
}
  ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="/mhoro/css/style.css" />
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

      <div class="login">
        <form action = "#" method = "post">
          <input type = "text" name="email" placeholder="E-mail" />
          <input type="password" name = "password" placeholder="Password"/>
          <input type="submit" name = "login" value= " login "/>

        </form>
      </div>
    </div>
  </div>
