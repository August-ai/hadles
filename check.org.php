<?php require "header.php"; require"includes/dbh.inc.php";?>

  <?php



  // set post like
  if (isset($_SESSION["userId"])) {
    $session = $_SESSION["userId"];
  }

  if (isset($_POST['add_cart']) && isset($_POST['organization_id'])) {

    $sql = "SELECT organization_id FROM user_cart WHERE organization_id=? AND user_id=?";
    $stmt = mysqli_stmt_init($conn);

    $o_n = mysqli_real_escape_string($conn, $_POST['organization_id']);


    if ((!mysqli_stmt_prepare($stmt,$sql))) {
      header("Location: mainpage.php?errorS=sqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt,"ii",$o_n,$session);
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
                    mysqli_stmt_bind_param($stmt,"ii",$o_n,$session);
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

    if (isset($_POST['like']) && isset($_POST['organization_name']) && isset($session)) {

      $sql = "SELECT liked_organization_name FROM user_liked WHERE REPLACE(LOWER(liked_organization_name), ' ', '') = ? AND user_id=?";
      $stmt = mysqli_stmt_init($conn);

      $o_nx = str_replace('_', '', strtolower(mysqli_real_escape_string($conn, $_POST['organization_name'])));

      $o_n = str_replace('_', ' ', strtolower(mysqli_real_escape_string($conn, $_POST['organization_name'])));




      $sqlverifienum = "SELECT likes FROM all_organizations WHERE REPLACE(LOWER(organization_name), ' ', '')='$o_nx'";

      if ((!mysqli_stmt_prepare($stmt,$sql))) {
        header("Location: ../mainpage.php?errorS=sqlerror");
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt,"si",$o_n,$session);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $resultCheck = mysqli_stmt_num_rows($stmt);

        $resultverified = mysqli_query($conn, $sqlverifienum);
        $queryResultVerified = mysqli_num_rows($resultverified);

        $z = false;

        if($rowverifie = mysqli_fetch_array($resultverified)) {
          if ($resultCheck >= 1) {

          }else {
            $verifiedrow = $rowverifie['likes']+1;

            if (!$z) {
                  $sql="INSERT INTO user_liked(liked_organization_name, user_id) VALUES (?,?)";
                  $stmt = mysqli_stmt_init($conn);

                  $sqlLikes = "UPDATE all_organizations SET all_organizations.likes =? WHERE REPLACE(LOWER(organization_name), ' ', '')=?";
                  $stmtLikes = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt,$sql) ||!mysqli_stmt_prepare($stmtLikes,$sqlLikes) ) {
                    echo "not working line 31";
                  }
                  else{
                    mysqli_stmt_bind_param($stmt,"si",$o_n,$session);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    mysqli_stmt_bind_param($stmtLikes,"is",$verifiedrow,$o_nx);
                    mysqli_stmt_execute($stmtLikes);
                    mysqli_stmt_store_result($stmtLikes);
                    $z = true;
                  }

                }else {

                }
              }
            }else {
                echo "There is a problem";
            }
        }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);

      echo "$o_n";
  		exit;
  	}

    // set post unlike
  	if (isset($_POST['unlike']) && isset($_POST['organization_name']) && isset($session)) {

      $o_nx = str_replace('_', '', strtolower( mysqli_real_escape_string($conn, $_POST['organization_name'])));

      $o_n = str_replace('_', ' ', strtolower( mysqli_real_escape_string($conn, $_POST['organization_name'])));




  		// mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid=1");
  		// mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id=$postid");


      $user_id = $session;

      $sql = "SELECT liked_organization_name FROM user_liked WHERE REPLACE(LOWER(liked_organization_name), ' ', '') = ? AND user_id=?";
      $stmt = mysqli_stmt_init($conn);

      $sqlverifienum = "SELECT likes FROM all_organizations WHERE REPLACE(LOWER(organization_name), ' ', '') = '$o_nx'";


      if (!mysqli_stmt_prepare($stmt,$sql)) {
      }
      else{
        mysqli_stmt_bind_param($stmt,"si",$o_nx,$session);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        $resultverified = mysqli_query($conn, $sqlverifienum);
        $queryResultVerified = mysqli_num_rows($resultverified);

        if ($queryResultVerified >= 1) {
          if($rowverifie = mysqli_fetch_array($resultverified)){
          $likeTrac = $rowverifie['likes']-1;
          if ($resultCheck > 0) {
                $sql="DELETE FROM user_liked WHERE REPLACE(LOWER(liked_organization_name), ' ', '')=? AND user_id=?";
                $stmt = mysqli_stmt_init($conn);

                $sqlLikes = "UPDATE all_organizations SET all_organizations.likes = ? WHERE REPLACE(LOWER(organization_name), ' ', '') =?";
                $stmtLikes = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql) ||!mysqli_stmt_prepare($stmtLikes,$sqlLikes) ) {
                  echo "not working line 31";
                }
                else{
                  mysqli_stmt_bind_param($stmt,"si",$o_nx,$session);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_store_result($stmt);

                  mysqli_stmt_bind_param($stmtLikes,"is",$likeTrac,$o_nx);
                  mysqli_stmt_execute($stmtLikes);
                  mysqli_stmt_store_result($stmtLikes);

                }
              }else{
                //if there is no resultl
              }
            }
        }else {
          echo "user reGET url";
        }
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);

      echo "".$_POST['organization_name']."";
  		exit();
  	}

    ?>





    <?php

    $organization_result = strtolower(str_replace(' ', '', $_GET['o']));
    $organization_search = mysqli_real_escape_string($conn, $organization_result);
    $organization = mysqli_real_escape_string($conn, $_GET['o']);
    $name = strtolower($organization);

    $sql = "SELECT * FROM all_organizations,organizations_img WHERE REPLACE(all_organizations.organization_name,' ', '')= '$organization_search'
    AND REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);


  // if isset button
  if (!isset($_SESSION["userId"])) {
    $row_class = 1;

    while($row = mysqli_fetch_array($result)){

      $row_id = $row["organization_id"];

      $sqlRelated = "SELECT all_organizations.organization_name,organizations_img.name FROM all_organizations,organizations_img WHERE
      ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
      OR ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
      OR ((all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]')  AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
      OR ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
      OR ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_name!= '$row[1]')  AND (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')))
      OR ((all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_name!= '$row[1]')  AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
      OR ((all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
      ORDER BY RAND() LIMIT 6";
      $resultRelated = mysqli_query($conn, $sqlRelated);

      $queryResultRelated = mysqli_num_rows($resultRelated);

      echo '
      <div class="main_resume_container">
      <div class="center_side_page">
        <div class="center_side_page_cont">
        <div class="resume_title"><h1>'.ucwords($row["organization_name"]). '</h1><hr class="title_line"></div>
          <div class="check_org_resume"><p>'.$row['organization_resume'].'</p></div>
        </div>
      </div>
      <div class=right_side_page>
        <div class="img_sc_bt">
        <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" />
        <div class="button_container">
        <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case " id="donate_bt_re_cont">Donate</button></a>





        </button>';

        $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
        $stmt_cart = mysqli_stmt_init($conn);


        if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
          header("Location: mainpage.php?errorS=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
          mysqli_stmt_execute($stmt_cart);
          mysqli_stmt_store_result($stmt_cart);

          $resultCheck = mysqli_stmt_num_rows($stmt_cart);


          $z = false;

            if ($resultCheck >= 1) {
              echo "<p class='p_align'>Added to <a href='cart.php'>your cart</a></p>";

            }else {

              echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search add_cart" id="add-cart-user"  data-id='.$row_id.' data-row="'.$row_class.'">Add to cart</button>';
              // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';
              echo "<p class='nagasaki p_align'>Added to <a href='cart.php'>your cart</a></p>";


          }
        }

        echo '</div>
        </div>
      </div>
      </div>
      <div class="left_side_page" id="bottom-page-related">
        <div class="left_side_related">
        <br>
        <Br>
        <br>
        <Br>
        <Br>
        <h3 class="related_org">Related</h3><hr class="title_line"><br>
        <Div id="response"></div>';

        if ($queryResultRelated >= 1) {
          echo "<div class='related-div'>";
          while($rowRealted = mysqli_fetch_array($resultRelated)){
            echo '<div class="img-container">
              <div class="org-logo">
              <a href="check.org.php?o=' . $rowRealted["organization_name"] .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($rowRealted['name'] ).'"class="img-thumnail img_size" /></a> </div>
              <a href="check.org.php?o=' . ucwords($rowRealted["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
            </div>';
          }
          echo "</div>";
        }else{
          echo 'Nothing is related';
        }

      echo '</div>
      </div>
      ';
    }
    mysqli_stmt_close($stmt_cart);
    mysqli_close($conn);


  }else if (isset($_SESSION['userId'])) {
    $sessionUSER = $_SESSION['userId'];
    $sqlliked = "SELECT * FROM user_liked WHERE REPLACE(user_liked.liked_organization_name,' ', '')= '$organization_search' AND user_liked.user_id = '$sessionUSER'";
    $resultliked = mysqli_query($conn, $sqlliked);
    $queryResultLiked = mysqli_num_rows($resultliked);
    if ($queryResult == 1) {
      $row_class = 1;

      while($row = mysqli_fetch_array($result)){
        $row_id = $row["organization_id"];


        $sqlRelated = "SELECT all_organizations.organization_name,organizations_img.name FROM all_organizations,organizations_img WHERE
        ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
        OR ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
        OR ((all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]')  AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
        OR ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
        OR ((all_organizations.organization_location='$row[2]') AND (all_organizations.organization_name!= '$row[1]')  AND (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')))
        OR ((all_organizations.organization_fight='$row[3]') AND (all_organizations.organization_name!= '$row[1]')  AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
        OR ((all_organizations.organization_type='$row[4]') AND (all_organizations.organization_name!= '$row[1]') AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')))
        ORDER BY RAND() LIMIT 6";
        $resultRelated = mysqli_query($conn, $sqlRelated);

        $queryResultRelated = mysqli_num_rows($resultRelated);

        echo '
        <div class="main_resume_container">
        <div class="center_side_page">
          <div class="center_side_page_cont">
          <div class="resume_title"><h1>'.ucwords($row["organization_name"]). '</h1><hr class="title_line"></div>
            <div class="check_org_resume"><p>'.$row['organization_resume'].'</p></div>
          </div>
        </div>
        <div class=right_side_page>
          <div class="img_sc_bt">

          <div class="button_container">
          <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" />
          <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case " id="donate_bt_re_cont">Donate</button></a>';
          //
          // $sql = "SELECT liked_organization_name FROM user_liked WHERE liked_organization_name=? AND user_id=?";
          // $stmt = mysqli_stmt_init($conn);
          //
          // if ((!mysqli_stmt_prepare($stmt,$sql))) {
          //   header("Location: ../mainpage.php?errorS=sqlerror");
          //   exit();
          // }
          // else{
          //   mysqli_stmt_bind_param($stmt,"si",$name,$sessionUSER);
          //   mysqli_stmt_execute($stmt);
          //   mysqli_stmt_store_result($stmt);
          //
          //   $resultCheck = mysqli_stmt_num_rows($stmt);
          //
          //
          //     if ($resultCheck >= 1) {
          //       // liked
          //
          //       echo '<button type="submit" name="dislike" class="signIn like-case like_bt_re_cont unlike" id="like-checks"data-name='.str_replace(' ', '_', strtolower(
          //         mysqli_real_escape_string($conn, $row["organization_name"]))).'><i class="fas fa-check"></i></button>';
          //
          //         echo '<button type="submit" name="like" class="signIn like-case like_bt_re_cont nagasaki like" id="like-none-check like" data-name='.str_replace(' ', '_', strtolower(
          //           mysqli_real_escape_string($conn, $row["organization_name"]))).'><span> Like </span></button>';
          //     }else {
          //     // not liked yet
          //
          //     echo '<button type="submit" name="like" class="signIn like-case like_bt_re_cont like" id="like-none-check like" data-name='.str_replace(' ', '_', strtolower(
          //       mysqli_real_escape_string($conn, $row["organization_name"]))).'><span> Like </span></button>';
          //
          //       echo '<button type="submit" name="dislike" class="signIn like-case like_bt_re_cont nagasaki unlike" id="like-checks"data-name='.str_replace(' ', '_', strtolower(
          //         mysqli_real_escape_string($conn, $row["organization_name"]))).'><i class="fas fa-check"></i></button>';
          //     }
          // }

          $sql_cart = "SELECT * FROM user_cart WHERE organization_id=? AND user_id=?";
          $stmt_cart = mysqli_stmt_init($conn);


          if ((!mysqli_stmt_prepare($stmt_cart,$sql_cart))) {
            header("Location: mainpage.php?errorS=sqlerror");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt_cart,"ii",$row["organization_id"],$session);
            mysqli_stmt_execute($stmt_cart);
            mysqli_stmt_store_result($stmt_cart);

            $resultCheck = mysqli_stmt_num_rows($stmt_cart);


            $z = false;

              if ($resultCheck >= 1) {
                echo "<p class='p_align'>Added to <a href='cart.php'>your cart</a></p>";

              }else {

                echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search add_cart" id="add-cart-user"  data-id='.$row_id.' data-row="'.$row_class.'">Add to cart</button>';
                // echo '<button type="submit" name="submit-donate" class="signIn add-case add-case-search remove_cart nagasaki" id="add-cart-user"  data-id='.$row_id.'>-  cart</button>';
                echo "<p class='nagasaki p_align'>Added to <a href='cart.php'>your cart</a></p>";
            }
          }
          echo '
          </div>
          </div>
        </div>
        </div>
        <div class="left_side_page" id="bottom-page-related">
          <div class="left_side_related">
          <br>
          <Br>
          <br>
          <Br>
          <Br>
          <h3 class="related_org">Related</h3><hr class="title_line"><br>
          <Div id="response"></div>';


          if ($queryResultRelated >= 1) {
            echo "<div class='related-div'>";
            while($rowRealted = mysqli_fetch_array($resultRelated)){
              echo '<div class="img-container">
                <div class="org-logo">

                <a href="check.org.php?o=' . $rowRealted["organization_name"] .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($rowRealted['name'] ).'"class="img-thumnail img_size"/></a> </div>
                <a href="check.org.php?o=' . ($rowRealted["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
              </div>';
            }
            echo "</div>";
          }else{
            echo 'Nothing is related';
          }

        echo '</div>
        </div>
        ';

        mysqli_stmt_close($stmt_cart);
        mysqli_close($conn);
      }
    }else{
      echo "Something got wrong, we'll try to fix it as soon as possible";
    }

  }else {
    echo "A problem occured please retry";
  }
  ?>

<?php require "footer.php"; ?>

<script type="text/javascript">
function like_check() {
    document.getElementById("like-none-check").style.display = "none";
    document.getElementById("like-check").style.display = "inline";
}

function like_discheck() {
    document.getElementById("like-none-check").style.display = "inline";
    document.getElementById("like-check").style.display = "none";

}

</script>

<script src="jquery.min.js"></script>
<script>
  $(document).ready(function(){
    // when the user clicks on like

    // when the user clicks on unlike
    $('.unlike').on('click', function(){
      var organization = $(this).data('name');
        $post = $(this);

      $.ajax({
        // url: 'check.org.php',
        type: 'post',
        data: {
          organization_name: organization,
          unlike: 1
        },
        success: function(response){
          // $('#response').text('name : ' + response);
          $post.addClass('nagasaki');
					$post.siblings().removeClass('nagasaki');
        }
      });
      return false;
    });
    $('.like').on('click', function (e) {
      var organization = $(this).data('name');
      $post = $(this);
              $.ajax({
                type: 'post',
                // url: 'check.org.php',   // here your php file to do something with postdata
                data: {
                  organization_name: organization,
                  like: 1
                }, // here you set the data to send to php file
                success: function (response) {
                  // $('#response').text('name : ' + response);
                  $post.addClass('nagasaki');
        					$post.siblings().removeClass('nagasaki');

                }
              });
              e.preventDefault();
            });
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




<!-- <div class="btn btn-primary tooltip">
<button type="submit" name="like" class="signIn like-case like_bt_re_cont" id="like-none-check" data-name='.str_replace(' ', '_', strtolower(
  mysqli_real_escape_string($conn, $row["organization_name"]))).'><span> Like </span>
  <div class="bottom">
    <h3>You need to <a href="#">Sign Up</a></h3>
    <p>Dolor sit amet, consectetur adipiscing elit.</p>
    <i></i>
  </div>
</button>
</div> -->



<!--  DISEABLED LIKE BUTTOM

<button type="submit" name="like" class="signIn like-case like_bt_re_cont" id="like-none-check" data-name='.str_replace(' ', '_', strtolower(
  mysqli_real_escape_string($conn, $row["organization_name"]))).'><span> Like </span> -->
