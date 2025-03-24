<?php

if(isset($_POST['post'])){
    $insert_posted_by = $id;
    $insert_posted_to = $user_profile;
    $insert_comment = $_POST['comment'];
    date_default_timezone_set('Europe/Berlin');
    $date = date('Y-m-d H:i:s');

    $result = mysqli_query($con, "INSERT INTO posts VALUES('','$insert_posted_by', '$insert_posted_to','$insert_comment','$date','0','' )");
}

if(isset($_POST['replys'])){
    $reply_posted_by = $id;
    $reply_posted_to = $user_profile;
    $reply_comment = $_POST['id'];
    date_default_timezone_set('Europe/Berlin');
    $date = date('Y-m-d H:i:s');

    $parent_post = $_POST['value'];
    $result = mysqli_query($con, "INSERT INTO posts VALUES('','$reply_posted_by', '$reply_posted_to','$reply_comment','$date','1','$parent_post ' )");
}

function random()
{

}

if(isset($_POST['reply'])){
    $reply_posted_by = $id;
    $reply_posted_to = $user_profile;
    $reply_comment = $_POST['comment'];
    date_default_timezone_set('Europe/Berlin');
    $date = date('Y-m-d H:i:s');
    echo $_POST['value'];
    $result = mysqli_query($con, "INSERT INTO posts VALUES('','$insert_posted_by', '$insert_posted_to','$insert_comment','$date','0','' )");
}


  function get_comments($user_profile)
  {
    include ("inc/connect.php");

    $result = mysqli_query($con, "SELECT * FROM posts WHERE posted_to = '$user_profile' AND post_status= '0'  ORDER BY id desc ");
    $row_count = mysqli_num_rows($result);

    $results = mysqli_query($con, "SELECT * FROM posts WHERE posted_to = '$user_profile' AND post_status= '1'  ORDER BY id desc ");
    $row_count = mysqli_num_rows($result);

    if($row_count == 0)
    {
      echo "No Status Updates Yet";
    }
    else {
      echo "<div class = 'post'>";



      foreach ($result as $item) {
        $id = $item['id'];
        $posted_by = $item['posted_by'];
        $posted_to = $item['posted_to'];
        $date = $item['date'];
        $dates = date_format ( new DateTime($date) , 'd-m-Y' );

        $comment = $item['comment'];

        $post_status = $item['post_status'];
        $post_parent = $item['post_parent'];

        $result_profile = mysqli_query($con, "SELECT * FROM users WHERE id = '$posted_by'");

        $row_result = mysqli_fetch_assoc($result_profile);

        @$first_name = $row_result['first_name'];
        @$last_name = $row_result['last_name'];

        if($row_result["profile_pic"]){
          $profile_pic_post = "user_data/profile_pics/" . $row_result["profile_pic"];
        }

        else{
          $profile_pic_post = "http://adci.net.au/wp-content/uploads/2014/08/profile-icon.png";
        }


        echo "<div class= 'header'>
        <img src ='$profile_pic_post'  align='left' width = '9%''/>
         $first_name $last_name <br/>
        <span class = 'date'> $dates  </span><br/>


        <div class = 'message'>
        <br/>
        $comment
        <br/>
        <br/>";

        echo "<div class = 'box'><form action='#' method = 'post'>
        <textarea = 'text'  name='id' style='margin: 0px; width:100%; height: 30px;''></textarea><br />
        <input type='hidden' name='value' value='$id'>
        <input type= 'submit' value= ' reply ' name = 'replys'>
        </form></div></div>";

echo "<div>";

          foreach ($results as $item) {


            $reply_posted_by = $item['posted_by'];
            $reply_posted_to = $item['posted_to'];
            $reply_date = $item['date'];
            $reply_dates = date_format ( new DateTime($date) , 'd-m-Y' );

            $reply_comment = $item['comment'];

            $reply_post_status = $item['post_status'];
            $reply_post_parent = $item['post_parent'];

            if(@$reply_post_parent == $id)
            {
              echo "<div class = 'reply'>
              <img src ='http://adci.net.au/wp-content/uploads/2014/08/profile-icon.png'  align='left' width = '4%''/>
              $reply_posted_by
              <span class = 'date'>   $reply_dates  </span>



              $reply_comment
              <br/>
              <br/></div>";
            }
          }


      }
    }
  }
 ?>
