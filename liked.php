<?php require "header.php"; require "includes/dbh.inc.php"; ?>
<?php

if (isset($_POST['add_cart']) && isset($_POST['organization_id'])) {

  $sql = "SELECT organization_id FROM user_cart WHERE organization_id=? AND user_id=?";
  $stmt = mysqli_stmt_init($conn);

  $o_n = mysqli_real_escape_string($conn, $_POST['organization_id']);


  if ((!mysqli_stmt_prepare($stmt,$sql))) {
    header("Location: mainpage.php?errorS=sqlerror");
    exit();
  }
  else{
    mysqli_stmt_bind_param($stmt,"ii",$o_n,$_SESSION['userId']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $resultCheck = mysqli_stmt_num_rows($stmt);


    $z = false;

      if ($resultCheck >= 1) {

      }else {
          if (!$z) {
                $sql="INSERT INTO user_cart(organization_id, user_id) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                }
                else{
                  mysqli_stmt_bind_param($stmt,"ii",$o_n,$_SESSION['userId']);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_store_result($stmt);

                  $z = true;
                }
              }else {

              }
        }
    }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  echo "$o_n";
  exit;
}



$sessionS = $_SESSION['userId'];
$organization_array = array();
$index = 0;

echo "<div class='main-search-result-box'>
<h2>Liked Organization</h2>";
$sql = "SELECT * FROM user_liked, all_organizations,organizations_img WHERE (REPLACE(LOWER(all_organizations.organization_name),' ', '') = REPLACE(LOWER(user_liked.liked_organization_name),' ', '')) AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
LOWER(REPLACE(organizations_img.organization_name,' ', '')) AND user_liked.user_id = '$sessionS' ORDER BY user_liked.time DESC";
$result = mysqli_query($conn, $sql);
$queryResult = mysqli_num_rows($result);

if ($queryResult > 0) {
  echo "<br>
  <div class='organizations_search'>";
  $row_class = 1;


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
      echo "<div class='search-box-container'>";
      echo "<h1>". ucwords($row['organization_name']) ."</h1><br>";
      echo '<div class="org-logo">
       <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round_img_re search-img" />

       <div class="choice-user">
       <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case donate-case-search" id="donate-user">Donate</button></a>';

       $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
       $stmt_cart = mysqli_stmt_init($conn);


       if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
         header("Location: mainpage.php?errorS=sqlerror");
         exit();
       }
       else{
         mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$_SESSION['userId']);
         mysqli_stmt_execute($stmt_cart);
         mysqli_stmt_store_result($stmt_cart);

         $resultCheck = mysqli_stmt_num_rows($stmt_cart);


         $z = false;

           if ($resultCheck >= 1) {
             echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search check-user_full">Check</button></a>';
             echo "<p>added to <a href='cart.php'>your cart</a></p>";

           }else {
             echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case check-case-search small_case small_case'.$row_class.'" id="check-user">Check</button></a>';


             echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search add_cart" id="add-cart-user"  data-id='.$row_id.' data-row="'.$row_class.'">add to cart</button>';
             // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';
             echo "<p class='nagasaki'>added to <a href='cart.php'>your cart</a></p>";


         }
       }
       echo '</div>
       </div>
       </div>';
       $organization_array[$index] = $row["organization_name"];
    }
    $index++;
    $row_class++;
  }
  // $i = 0;
  // foreach ($organization_array as $organization => $value) {
  //   echo "$organization_array[$i]<br>";
  //   $i++;
  // }
  echo "</div>";
}else {
  echo "Nothing liked yet";
}
 ?>

 <script src="jquery.min.js"></script>
 <script>
   $(document).ready(function(){
     // when the user clicks on like

     // when the user clicks on unlike
     $('.add_cart').on('click', function (e) {

       var organization = $(this).data('id');
       $post = $(this);
       $row = $(this).data('row');

               $.ajax({
                 type: 'post',
                 // url: '',   // here your php file to do something with postdata
                 data: {
                   organization_id: organization,
                   add_cart: true
                 }, // here you set the data to send to php file
                 success: function (response) {
                   $post.addClass('nagasaki');
                   $post.siblings().removeClass('nagasaki');
                   $('.small_case' +  $row).addClass('check-user_full');
                 }
               });
               e.preventDefault();
             });
   });
 </script>
