<?php include ("inc/home_header.php") ?>
<?php require "php/functions.php"; ?>

<?php
  if(isset($_POST["addfriend"]))
  {
    $friend_request = $_POST["addfriend"];

    $user_to = $user_profile;
    $user_from = $id;

    date_default_timezone_set('Europe/Berlin');
    $date = date('Y-m-d H:i:s');

    $friend_request_query = mysqli_query($con, "INSERT INTO friend_requests VALUES('', '$user_from', '$user_to', '$date')");
    echo "your friend request has been sent";
  }
?>
  <div class="content">
    <div class="main_content">

      <div class="left">
        <img src ="<?php echo $profile_pic_url ?>" width = "95%"/>
        <p><?php echo $first_name . " " . $last_name?></p>
      <?php  if($id != $user_profile)
        {
          echo "<br />
          <form action =''  method = 'POST'>
          <input type = 'submit' name = 'addfriend' = 'add as friend' value = ' add as friend '/>
          <input type = 'submit' name = 'addfriend' = 'add as friend' value = ' send a message '/>
          </form>

          ";
        }?>
        <br />
        <h3 style= "text-align: center;"> Notifications </h3>
        <br />
      </div>

      <div class="right">
        <form action = "#" method="post">

        <textarea name = "comment" style="margin: 0px; width: 568px; height: 70px;">
        </textarea>
        <input type="submit" value=" Post " name = "post" />
      </form>
      </div>

      <div class="right2">
          <?php get_comments($user_profile) ?>

      </div>

    </div>
  </div>
