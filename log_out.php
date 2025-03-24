<?php include ("../mhoro/inc/header.php"); ?>

<?php

if($_SESSION['user_login'])
{
  session_destroy();
  header("location: index.php");
}
?>
