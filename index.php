<?php include ("../mhoro/inc/header.php"); ?>
<?php
$reg = @$_POST['reg'];

$fn = "";
$ln = "";
$email = "";
$password = "";
$password2 = "";
$d= "";

$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$email = strip_tags(@$_POST['mail']);
$password = strip_tags(@$_POST['pass1']);
$password2 = strip_tags(@$_POST['pass2']);
$d = date("Y-m-d");

if($fn && $ln && $email && $password)
{
  if($password == $password2)
  {
    $query = mysqli_query($con, "INSERT INTO users VALUES('', '$fn', '$ln', '$email', '$password','$d', '0','','')");
  }
}
?>

<?php

if(isset($_POST['email']) && isset($_POST['password'])){
  $user_login= $_POST['email'];
  $pass = $_POST['password'];

  $sql="SELECT id FROM users WHERE email = '$user_login' AND password='$pass'";

  $result=mysqli_query($con,$sql);

  $row = "";

  if($result)
  {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user_login"] = $row["id"];
    header("location: index.php");
  }

  else
  {
    echo "Error";
  }

}
?>



  <content>
    <div class="main_content">

      <div class="left">
        <h2>Sign Up </h2>
        <form action= "#" method="POST">
          <input type = "text" name="fname"  placeholder="First Name"/>
          <input type = "text" name="lname" placeholder="Last Name"/>
          <input type = "text" name="mail" placeholder="E-mail"/>
          <input type = "text" name="pass1" placeholder="Password"/>
          <input type = "text" name="pass2" placeholder="Repeat Password"/> <br/>
          <input type="submit" name = "sign_up" value= "sign up" />
        </form>

      </div>
      <div class="right">
        <a data-flickr-embed="true"  href="https://www.flickr.com/photos/smemon/5423247360/in/photolist-9geyuQ-9FmwC3-8U4zXb-qoRn96-nGiWxb-kLnihT-72n24g-7NCyZE-6hxAb9-e9sFph-abis6z-2abJDW-9x5Prp-4RFVnu-nLQpAV-6hxAaJ-7Dc5Dh-9geyBC-4uG5C1-8TP4A7-98cXsh-pTH1LB-8U4xqA-9thJVu-gvuSTD-czHkYU-JxpKf-9iuGTh-5WXaBH-41mabz-eZJ7by-99t4Pa-6xCw9d-9tApmX-rVAX8t-h6ofo3-kLnhER-8w6RQs-qbtQTC-98eeXn-ec8Gb8-i556Cm-7G2kEG-8BZCvh-7o3nrY-6e17SN-br5x86-4c6tnn-ayZi8V-n1SP" title="social wordle">
        <img src="https://farm6.staticflickr.com/5051/5423247360_8a50d029a1_b.jpg" width="100%" height="auto" alt="social wordle">
        </a><script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>
        <br/>
        <br/><br/>
        <p>
      <a href= "#">About</a><br />
      <a href= "#">Download Source code</a><br />
      <a href= "#">About Munashe Gumbonzvanda</a><br /><br />
    Mhoro is a Munashe Gumbonzvanda project to create a functional social network, following the tutorials at HowCode</p>
    </div>

    </div>
  </content>
<?php include ("../mhoro/inc/footer.php"); ?>

</body>
</html>
