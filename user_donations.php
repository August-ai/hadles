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
   // if (isset($_POST['remove_carthds']) && isset($_POST['organization_id'])) {
   //
   //   $sql = "SELECT organization_id FROM user_cart WHERE organization_id=? AND user_id=?";
   //   $stmt = mysqli_stmt_init($conn);
   //
   //   $o_n = mysqli_real_escape_string($conn, $_POST['organization_id']);
   //
   //
   //   if ((!mysqli_stmt_prepare($stmt,$sql))) {
   //     header("Location: ../mainpage.php?errorS=sqlerror");
   //     exit();
   //   }
   //   else{
   //     mysqli_stmt_bind_param($stmt,"ii",$o_n,$session);
   //     mysqli_stmt_execute($stmt);
   //     mysqli_stmt_store_result($stmt);
   //
   //     $resultCheck = mysqli_stmt_num_rows($stmt);
   //
   //
   //     $z = false;
   //
   //       if ($resultCheck >= 1) {
   //         if (!$z) {
   //               $sql="DELETE FROM user_cart WHERE user_id=? AND organization_id=?";
   //               $stmt = mysqli_stmt_init($conn);
   //               if (!mysqli_stmt_prepare($stmt,$sql)) {
   //               }
   //               else{
   //                 mysqli_stmt_bind_param($stmt,"ii",$session,$o_n);
   //                 mysqli_stmt_execute($stmt);
   //                 mysqli_stmt_store_result($stmt);
   //
   //                 $z = true;
   //               }
   //             }else {
   //
   //             }
   //       }else {
   //       }
   //     }
   //   mysqli_stmt_close($stmt);
   //   mysqli_close($conn);
   //
   //   echo "$o_n";
   //   exit;
   // }
   $organization_array = array();
   $donation_array = array();
   $timelaps_array = array();
   $date_array = array();

   $index = 0;

   echo "<div class='main_donation_container'>
   ";
   $sql = "SELECT * FROM transactions, all_organizations, organizations_img WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
   LOWER(REPLACE(organizations_img.organization_name,' ', ''))) ORDER BY transactions.time DESC";
   $result = mysqli_query($conn, $sql);
   $queryResult = mysqli_num_rows($result);

   $sqlMthly = "SELECT * FROM transactions, all_organizations,organizations_img WHERE (all_organizations.organization_id = transactions.organizationId) AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
   LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND transactions.userId = '$session' AND (transactions.timelaps = 'monthly' OR transactions.timelaps = 'Monthly') ORDER BY transactions.time DESC";
   $resultM = mysqli_query($conn, $sqlMthly);
   $queryResultM = mysqli_num_rows($resultM);

   $sqlSngle = "SELECT * FROM transactions, all_organizations,organizations_img WHERE (all_organizations.organization_id = transactions.organizationId) AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
   LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND transactions.userId = '$session' AND (transactions.timelaps = 'single' OR transactions.timelaps = 'Single') ORDER BY transactions.time DESC";
   $resultS = mysqli_query($conn, $sqlSngle);
   $queryResultS = mysqli_num_rows($resultS);

   if ($queryResult > 0) {
     $row_num = 1;

     echo "
     <div class='b_all-dc'>
     <br>
     <h2>Donations</h2><br>";

     if ($queryResultM > 0) {
       echo "<div class='fl_lft'><h3>Your Monthly Donations</h3><br>";
       while ($row = mysqli_fetch_assoc($resultM)) {
         $row_id = $row["organization_id"];

           echo "<div class='donation_box_container".$row_num." donation_pos' data-num=".$row_num.">";
           echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';

           echo '<div class="org-logo">
            <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />

            <div>
              <div class="donation_choice_user">
                <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search donation_sc">Donate</button></a>
                <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search donation_scc" id="check-user">Check</button></a>
              </div>
              <div class="mny_pos">
                <h2>$'.$row["amount"].'</h2>
              </div>
            </div>
            <div class="plus-donations_details">
              <h4>see details</h4>
            </div>

            </div>
            </div>';

            // deleted item

          $row_num++;
          $organization_array[$index] = $row["organization_name"];
          $donation_array[$index] = $row["amount"];
          $timelaps_array[$index] = $row["timelaps"];
          $date_array[$index] = $row["time"];
          $index++;
       }
       echo "</div>";
     }
     if ($queryResultS > 0) {
       echo "</br><div class='fl_lft top_sparting'><h3>Your Single Donations</h3></br>";

       while ($row = mysqli_fetch_assoc($resultS)) {
         $row_id = $row["organization_id"];

           echo "<div class='donation_box_container".$row_num." donation_pos' data-num=".$row_num.">";
           echo '<div class="content-fit"><a href="check.org.php?o=' .$row["organization_name"] .'" class="check_text-t"><h2 class="h2-resize">'.ucwords($row["organization_name"]).'</h2></a></div><br/>';

           echo '<div class="org-logo">
            <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />

            <div>
              <div class="donation_choice_user">
                <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search donation_sc">Donate</button></a>
                <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search donation_scc" id="check-user">Check</button></a>
              </div>
              <div class="mny_pos">
                <h2>$'.$row["amount"].'</h2>
              </div>
            </div>
            <div class="plus-donations_details">
              <h4>see details</h4>
            </div>

            </div>
            </div>';

            // deleted item

          $row_num++;
          $organization_array[$index] = $row["organization_name"];
          $donation_array[$index] = $row["amount"];
          $timelaps_array[$index] = $row["timelaps"];
          $date_array[$index] = $row["time"];
          $index++;
       }
       echo "</div>";
     }
     // $i = 0;
     // foreach ($organization_array as $organization => $value) {
     //   echo "$organization_array[$i]<br>";
     //   $i++;
     // }
     echo "</div>";
     $x = 1;
     while ($x < $row_num) {
       if ($timelaps_array[$x-1] == "single" ||$timelaps_array[$x-1] == "Single") {
         $timelaps_array[$x-1] = "Once";
       }
       $org_upcase = ucwords($organization_array[$x-1]);
       echo "<div class='pop-up_div pop".$x." nagasaki' id='pop_id' data-num='$x'>
        <a href='check.org.php?o=".$organization_array[$x-1]."'><h2 class='f_space-t'>".$org_upcase."</h2></a>
        <h3 class='space-th2'>Donation of: $".$donation_array[$x-1]."</h3>
        <h3 class='space-th2'>Giving: ".$timelaps_array[$x-1]."</h3>
        <h3 class='date_t'>Date: ".$date_array[$x-1]."</h3>
       </div>";
       $x++;
     }

   }else {
     echo "<br><h2>Your Donations</h2>
     <p>You have not Donated yet</p>
    ";

   }
   echo "</div>";
   require "pre-footer.php";
   

   require "footer.php";

 }else {

 }
?>

  <!--
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
  </script> -->
  <script src="jquery.min.js"></script>
  <script type="text/javascript">
  // var a = $( "pop-up_div" ).data( "num" ); // 52
  // alert(a);

  $(document).ready(function(){

    $('.donation_pos').on('click', function(){

      $('.pop-up_div').addClass("nagasaki");
      var num = $(this).data('num');
      $('.pop' + num).removeClass('nagasaki');
      $('.b_all-dc').addClass('f_opac');
      $('.b_all-dc').addClass('dis_hrf');
      $('.top-nav').addClass('f_opac');
    });
  });

  $('body').click(function(evt){
         // if(evt.target.className == "donation_pos")
         //   if ($('.pop-up_div').hasClass('nagasaki')) {
         //     $('.pop-up_div').removeClass('nagasaki');
         //     return;
         //
         //   }else {
         //     $('.pop-up_div').addClass('nagasaki');
         //     return;
         //   }
         //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
         if($(evt.target).closest('.donation_pos').length)
            return;
            $(".pop-up_div").addClass("nagasaki");
            $('.b_all-dc').removeClass('f_opac');
            $('.b_all-dc').removeClass('dis_hrf');
            $('.top-nav').removeClass('f_opac');
        //Do processing of click event here for every element except with id menu_content

  });
  //   $('.donation_pos').on('click', function (e) {
  //     if ($('.pop-up_div').hasClass('nagasaki')) {
  //       $('.pop-up_div').removeClass('nagasaki');
  //     }
  //   });


  </script>
