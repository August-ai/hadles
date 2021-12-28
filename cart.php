<?php require "header.php";
  require "includes/dbh.inc.php";

 ?>
 <?php



 // if (!isset($session) && !isset($_SESSION['unsigned_Id'])) {
 //
 //   while (!isset($_SESSION['unsigned_Id'])) {
 //
 //     $rand_id = RAND(999999, 99999999);
 //
 //     $sqlExist = "SELECT organization_id FROM users WHERE user_id='$rand_id'";
 //     $result = mysqli_query($conn, $sqlExist);
 //     $queryResult = mysqli_num_rows($result);
 //
 //     if ($queryResult >= 1) {
 //
 //     }
 //     else {
 //       $_SESSION['unsigned_Id'] = $rand_id;
 //     }
 //   }
 //
 // }
 //
 // if (isset($session)) {
 //   $session = $session;
 // }else {
 //   $session = $_SESSION['unsigned_Id'];
 // }


 if (isset($session)) {
   if (isset($_POST['remove_carthds']) && isset($_POST['organization_id'])) {

     $sql = "SELECT organization_id FROM user_cart WHERE organization_id=? AND user_id=?";
     $stmt = mysqli_stmt_init($conn);

     $o_n = mysqli_real_escape_string($conn, $_POST['organization_id']);


     if ((!mysqli_stmt_prepare($stmt,$sql))) {
       header("Location: ../mainpage.php?errorS=sqlerror");
       exit();
     }
     else{
       mysqli_stmt_bind_param($stmt,"ii",$o_n,$session);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_store_result($stmt);

       $resultCheck = mysqli_stmt_num_rows($stmt);


       $z = false;

         if ($resultCheck >= 1) {
           if (!$z) {
                 $sql="DELETE FROM user_cart WHERE user_id=? AND organization_id=?";
                 $stmt = mysqli_stmt_init($conn);
                 if (!mysqli_stmt_prepare($stmt,$sql)) {
                 }
                 else{
                   mysqli_stmt_bind_param($stmt,"ii",$session,$o_n);
                   mysqli_stmt_execute($stmt);
                   mysqli_stmt_store_result($stmt);

                   $z = true;
                 }
               }else {

               }
         }else {
         }
       }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);

     echo "$o_n";
     exit;
   }
   $organization_array = array();
   $index = 0;

   echo "<div class='main-search-result-box'>
   <br>
   <h2>Cart</h2>";
   $sql = "SELECT * FROM user_cart, all_organizations,organizations_img WHERE (all_organizations.organization_id = user_cart.organization_id) AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
   LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND user_cart.user_id = '$session' ORDER BY user_cart.time DESC";
   $result = mysqli_query($conn, $sql);
   $queryResult = mysqli_num_rows($result);

   if ($queryResult > 0) {
     $row_num = 1;

     echo "<br>
     <div class='organizations_search'>";
     while ($row = mysqli_fetch_assoc($result)) {
       $row_id = $row["organization_id"];
       $dupplicate = false;
       $indexArray = 0;
       foreach ($organization_array as $organization => $value) {
         if ($organization_array[$indexArray] == $row["organization_name"]) {
           $dupplicate = true;
         }
         $indexArray++;
       }
       if ($dupplicate) {
         // code...
       }else {
         echo "<div class='search-box-container search-box-container".$row_num."'>";
         echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';

         echo '<div class="org-logo">
          <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />

          <div class="choice-user">
          <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>

        <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search check-user_full full_width-s cart_check-bt" id="check-user">Check</button></a>

        <p><a href="cart.php" class="remove_carthds" data-id='.$row_id.' data-row='.$row_num.'>Remove from cart</a></p>

          </div>
          </div>
          </div>';

          // deleted item
          echo "<div class='search-box-container_remove rem_square".$row_num." nagasaki search-box-container".$row_num."'>";
            echo '<p><a href="check.org.php?o=' . $row["organization_name"] .'">'.ucwords($row["organization_name"]).'</a> was Removed</p>
          </div>';

          $organization_array[$index] = $row["organization_name"];
       }
       $index++;
       $row_num++;
     }
     // $i = 0;
     // foreach ($organization_array as $organization => $value) {
     //   echo "$organization_array[$i]<br>";
     //   $i++;
     // }
     echo "</div></div>";
   }else {
     echo "Nothing in the cart yet";
     echo "</div>";
   }
 }else {
   echo "<div class='main-search-result-box'>
   <br>
   <h2>Cart</h2>";
   echo "<p><a href='login.php'>Sign In</a> to use Cart</p></div>";

 }
  ?>

  <script src="jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      // when the user clicks on like

      // when the user clicks on unlike
      $('.remove_carthds').on('click', function(){
        var organization = $(this).data('id');
          $post = $(this);

          $row_num = $(this).data('row');

        $.ajax({
          // url: 'check.org.php',
          type: 'post',
          data: {
            organization_id: organization,
            remove_carthds: true
          },
          success: function(response){
            // $('#response').text('name : ' + response);
            // $post.addClass('nagasaki');
            // $post.siblings().removeClass('nagasaki');

            $('.search-box-container' + $row_num).addClass('nagasaki');
            $('.rem_square' + $row_num).removeClass('nagasaki');

          }
        });
        return false;
      });
    });
  </script>

  <?php require "pre-footer.php"; ?>
