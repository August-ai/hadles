<?php
if (!isset($session)) {
  $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
   ORDER BY RAND() LIMIT 4"; // CHANGE LATER (likes and DONATIONS)
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: mainpage.php?errorS=sqlerror");
    exit();
  }else{
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck <= 0) {
      header("Location: mainpage.php?error=noresult");
      exit();
    }else{
      $i = 1;
      $result = mysqli_query($conn,$sql);
      echo '<div class="ms-pop">
        <br>
        <div class="choice-box">
          <ul>
          <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>

          ';
          
    while($row = mysqli_fetch_array($result)){
     echo '
        <li>
          <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
          <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

        </li>';
      }
      echo '
      </ul>
    </div>
  </div>';
    }
  }
}

// Explore more

//<div class="m_p_container_ex-m"><a href="#"><h1 class="normal-text m_p_text-ex-m">Explore more</h1></a></div>



// ancien modal 'save the children'
// echo '
//        <li id="row-modal">
//        <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img"id="image-size-n3" /> </div></a>
//          <h2 class="f-info space-text-marg">Helping in: ' . ucwords($row["organization_location"]) .'</h2>
//          <h2 class="f-info">Fighting For: ' . ucwords($row["organization_fight"]) .'</h2>
//          <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case" id="row-modal-button-don">Donate</button></a>
//        <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case"id="row-modal-button-chk">Check</button></a>
//      </li>';


else if (isset($session)) {
  $sqlFull = "SELECT * FROM user_cart, transactions, all_organizations WHERE ((transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) AND (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id)) ORDER BY RAND()";
  $stmtFull = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmtFull,$sqlFull)) {
    header("Location: mainpage.php?errorS=sqlerror");
    exit();
  }else{
    mysqli_stmt_execute($stmtFull);
    mysqli_stmt_store_result($stmtFull);
    $resultCheck = mysqli_stmt_num_rows($stmtFull);


    // DID NOT DONATED OR NOTHING IN CART
    if ($resultCheck <= 0) {

      $sqlC = "SELECT * FROM user_cart, all_organizations WHERE (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id) ORDER BY RAND()";
      $stmtC = mysqli_stmt_init($conn);

      $resultC1 = mysqli_query($conn,$sqlC);

      if (!mysqli_stmt_prepare($stmtC,$sqlC)) {
        header("Location: mainpage.php?errorS=sqlerror");
        exit();
      }else{
        mysqli_stmt_execute($stmtC);
        mysqli_stmt_store_result($stmtC);
        $resultCheckC = mysqli_stmt_num_rows($stmtC);
        // Nothing in cart
        if ($resultCheckC <= 0) {

          $slqT = "SELECT * FROM transactions, all_organizations WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) ORDER BY RAND()";
          $stmtT = mysqli_stmt_init($conn);

          $resultT1 = mysqli_query($conn,$slqT);

          if (!mysqli_stmt_prepare($stmtT,$slqT)) {
            header("Location: mainpage.php?errorS=sqlerror");
            exit();
          }else{
            mysqli_stmt_execute($stmtT);
            mysqli_stmt_store_result($stmtT);
            $resultCheckT = mysqli_stmt_num_rows($stmtT);

            // Did not donated
            if ($resultCheckT <= 0) {

              $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
               ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: mainpage.php?errorS=sqlerror");
                exit();
              }else{
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck <= 0) {
                  header("Location: mainpage.php?error=noresult");
                  exit();
                }else{
                  $i = 1;
                  $result = mysqli_query($conn,$sql);
                  echo '<div class="ms-pop">
                  <hr>
                    <br>
                    <div class="choice-box">
                    <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>
                    <br>
                      <ul>

                      ';
                while($row = mysqli_fetch_array($result)){
                 echo '
                      <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                      <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                      <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                    </li></a>';
                  }
                  echo '
                  </ul>
                </div>
              </div>';
                }
              }
              $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
               ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: mainpage.php?errorS=sqlerror");
                exit();
              }else{
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck <= 0) {
                  header("Location: mainpage.php?error=noresult");
                  exit();
                }else{
                  $i = 1;
                  $result = mysqli_query($conn,$sql);
                  echo '<div class="ms-pop">
                  <hr>
                    <br>
                    <div class="choice-box">
                    <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>
                    <br>
                      <ul>

                      ';
                while($row = mysqli_fetch_array($result)){
                 echo '
                      <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                      <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                      <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                    </li></a>';
                  }
                  echo '
                  </ul>
                </div>
              </div>';
                }
              }
              $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
               ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: mainpage.php?errorS=sqlerror");
                exit();
              }else{
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck <= 0) {
                  header("Location: mainpage.php?error=noresult");
                  exit();
                }else{
                  $i = 1;
                  $result = mysqli_query($conn,$sql);
                  echo '<div class="ms-pop">
                  <hr>
                    <br>
                    <div class="choice-box">
                    <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>
                    <br>
                      <ul>

                      ';
                while($row = mysqli_fetch_array($result)){
                 echo '
                      <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                      <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                      <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                    </li></a>';
                  }
                  echo '
                  </ul>
                </div>
              </div>';
                }
              }
              $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
               ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: mainpage.php?errorS=sqlerror");
                exit();
              }else{
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck <= 0) {
                  header("Location: mainpage.php?error=noresult");
                  exit();
                }else{
                  $i = 1;
                  $result = mysqli_query($conn,$sql);
                  echo '<div class="ms-pop">
                  <hr>
                    <br>
                    <div class="choice-box">
                    <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>
                    <br>
                      <ul>

                      ';
                while($row = mysqli_fetch_array($result)){
                 echo '
                      <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                      <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                      <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                    </li></a>';
                  }
                  echo '
                  </ul>
                </div>
              </div>';
                }
              }

            }else {
              $OrgDon = array();
              while ($rowT1 = mysqli_fetch_array($resultT1)) {
                $OrgDon[] = $rowT1["organization_name"];
              }
              $resultOT = mysqli_query($conn,$slqT);


              // "all the world"
              $count_loc = 0;

              // poverty
              $count_fight = 0;
              // hunger
              $count_fight2 = 0;
              // hunger&poverty
              $count_fight3 = 0;
              // disease
              $count_fight4 = 0;
              // abusation
              $count_fight5 = 0;

              // large
              $count_type = 0;
              // medium
              $count_type2 = 0;
              // small
              $count_type3 = 0;

              $loc = array();
              $fight = array();
              $type = array();
              $OrgDon = array();


              while($row = mysqli_fetch_array($resultOT)){

                 $loc[] = $row["organization_location"];
                 $fight[] = $row["organization_fight"];
                 $type[] = $row["organization_type"];

                 $OrgDon[] = $row["organization_name"];
              }



              foreach ($loc as $key => $value) {
                if ($value == "all the world") {
                  $count_loc++;
                }
              }

              foreach ($fight as $key => $value) {
                if ($value == "poverty") {
                  $count_fight++;
                }else if ($value == "hunger") {
                  $count_fight2++;
                }else if ($value == "hunger&poverty") {
                  $count_fight3++;
                }else if ($value == "disease") {
                  $count_fight4++;
                }else if ($value == "abusation") {
                  $count_fight5++;
                }
              }

              foreach ($type as $key => $value) {
                if ($value == "large") {
                  $count_type++;
                }else if ($value == "medium") {
                  $count_type2++;
                }else if ($value == "small") {
                  $count_type3++;
                }else {
                  // Default $value = large
                  $count_type++;
                }
              }
              // GET FIGHT, LOCATION AND TYPE NY NUMBER


              // echo "
              // // all the world
              // $count_loc;
              //
              // // poverty
              // $count_fight;
              // // hunger
              // $count_fight2;
              // // hunger&poverty
              // $count_fight3;
              // // disease
              // $count_fight4;
              // // abusation
              // $count_fight5;
              //
              // // large
              // $count_type;
              // // medium
              // $count_type2;
              // // small
              // $count_type3//<br><br>
              // ";

              $top_loc_value = max(0,$count_loc);

              $top_fight_value = max($count_fight, $count_fight2,$count_fight3,$count_fight4,$count_fight5);

              $top_type_value = max($count_type, $count_type2, $count_type3);

              // get highest fight choosen

              if ($top_fight_value == $count_fight && $top_fight_value == $count_fight2) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "poverty";
                }else{
                  $fight_name = "hunger";
                }
              }else if($top_fight_value == $count_fight && $top_fight_value == $count_fight3){
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "poverty";
                }else{
                  $fight_name = "hunger&poverty";
                }
              }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight4) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "poverty";
                }else{
                  $fight_name = "disease";
                }
              }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight5) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "poverty";
                }else{
                  $fight_name = "abusation";
                }
              }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight3) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "hunger";
                }else{
                  $fight_name = "hunger&poverty";
                }
              }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight4) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "hunger";
                }else{
                  $fight_name = "disease";
                }
              }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight5) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "hunger";
                }else{
                  $fight_name = "abusation";
                }
              }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight4) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "hunger&poverty";
                }else{
                  $fight_name = "disease";
                }
              }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight5) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "hunger&poverty";
                }else{
                  $fight_name = "abusation";
                }
              }else if ($top_fight_value == $count_fight4 && $top_fight_value == $count_fight5) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $fight_name = "disease";
                }else{
                  $fight_name = "abusation";
                }
              }else {
                if ($top_fight_value == $count_fight) {
                  $fight_name = "poverty";
                }else if ($top_fight_value == $count_fight2) {
                  $fight_name = "hunger";
                }else if ($top_fight_value == $count_fight3) {
                  $fight_name = "hunger&poverty";
                }else if ($top_fight_value == $count_fight4) {
                  $fight_name = "disease";
                }else {
                  $fight_name = "abusation";
                }
              }

              // get highest type choosen between 2 by rand()

              if ($top_type_value == $count_type && $top_type_value == $count_type2) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $type_name = "large";
                }else{
                  $type_name = "medium";
                }
              }else if($top_type_value == $count_type && $top_type_value == $count_type3){
                $rand = rand(1,2);
                if ($rand == 1) {
                  $type_name = "large";
                }else{
                  $type_name = "small";
                }
              }else if ($top_type_value == $count_type2 && $top_type_value == $count_type3) {
                $rand = rand(1,2);
                if ($rand == 1) {
                  $type_name = "medium";
                }else{
                  $type_name = "small";
                }
              }else {
                if ($top_type_value == $count_type) {
                  $type_name = "large";
                }else if ($top_type_value == $count_type2) {
                  $type_name = "medium";
                }else {
                  $type_name = "small";
                }
              }
              // end of highest type choosen by rand()
              $org_loc_sql = 'all the world';
              $sqlRelated = "SELECT * FROM all_organizations,organizations_img WHERE
              ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name')
               AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))

              OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
               (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
              OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
              OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
               (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
              OR ((all_organizations.organization_location='$org_loc_sql') AND
               (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
              OR ((all_organizations.organization_fight='$fight_name') AND
               (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
              OR ((all_organizations.organization_type='$type_name') AND
               (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' )) ORDER BY RAND() LIMIT 5";
               $stmtFRelated = mysqli_stmt_init($conn);
               $result = mysqli_query($conn,$sqlRelated);

               if (!mysqli_stmt_prepare($stmtFRelated,$sqlRelated)) {
                 header("Location: mainpage.php?errorS=sqlerror");
                 exit();
               }else{
                 mysqli_stmt_execute($stmtFRelated);
                 mysqli_stmt_store_result($stmtFRelated);
                 $resultCheck = mysqli_stmt_num_rows($stmtFRelated);
                 if ($resultCheck <= 0) {

                 }else {
                   echo '<div class="ms-pop">
                     <br>
                     <div class="choice-box">
                     <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommandations</h1></div>
                     <br> <ul>';
                   while($row = mysqli_fetch_array($result)){
                   echo '
                       <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                       <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                       <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

                     </li></a>';
                   }
                   echo '
                   </ul>
                   </div>
                   </div>';
                 }
               }
               $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
                ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
               $stmt = mysqli_stmt_init($conn);
               if (!mysqli_stmt_prepare($stmt,$sql)) {
                 header("Location: mainpage.php?errorS=sqlerror");
                 exit();
               }else{
                 mysqli_stmt_execute($stmt);
                 mysqli_stmt_store_result($stmt);
                 $resultCheck = mysqli_stmt_num_rows($stmt);
                 if ($resultCheck <= 0) {
                   header("Location: mainpage.php?error=noresult");
                   exit();
                 }else{
                   $i = 1;
                   $result = mysqli_query($conn,$sql);
                   echo '<div class="ms-pop">
                   <hr>
                     <br>
                     <div class="choice-box">
                     <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>
                     <br>
                       <ul>

                       ';
                 while($row = mysqli_fetch_array($result)){
                  echo '
                       <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                       <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                       <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                     </li></a>';
                   }
                   echo '
                   </ul>
                 </div>
               </div>';
                 }
               }

               $sqlT = "SELECT * FROM transactions, all_organizations, organizations_img WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id AND (LOWER(REPLACE(all_organizations.organization_name,' ', ''))=LOWER(REPLACE(organizations_img.organization_name,' ', '')))) ORDER BY RAND() LIMIT 1";
               $stmtT = mysqli_stmt_init($conn);
               $resultT1 = mysqli_query($conn,$sqlT);

               if (!mysqli_stmt_prepare($stmtT,$sqlT)) {
                 header("Location: mainpage.php?errorS=sqlerror");
                 exit();
               }else{
                 mysqli_stmt_execute($stmtT);
                 mysqli_stmt_store_result($stmtT);
                 $resultCheckT = mysqli_stmt_num_rows($stmtT);
                 if ($resultCheckT <= 0) {
                 }else {
                   while ($rowT1 = mysqli_fetch_array($resultT1)) {

                     $l = $rowT1["organization_location"];
                     $f = $rowT1["organization_fight"];
                     $t = $rowT1["organization_type"];

                     $slqTD = "SELECT * FROM all_organizations,organizations_img WHERE
                     ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t')
                      AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))

                     OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND
                      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
                     OR ((all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t') AND
                     (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
                     OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_type='$t') AND
                      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
                     OR ((all_organizations.organization_location='$l') AND
                      (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
                     OR ((all_organizations.organization_fight='$f') AND
                      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
                     OR ((all_organizations.organization_type='$t') AND
                      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' )) ORDER BY RAND() LIMIT 5";
                      $stmtTD = mysqli_stmt_init($conn);
                      $resultTD = mysqli_query($conn,$slqTD);

                      if (!mysqli_stmt_prepare($stmtTD,$slqTD)) {
                        header("Location: mainpage.php?errorS=sqlerror");
                        exit();
                      }else{
                        mysqli_stmt_execute($stmtTD);
                        mysqli_stmt_store_result($stmtTD);
                        $resultCheck = mysqli_stmt_num_rows($stmtTD);
                        if ($resultCheck <= 0) {

                        }else {
                          $dupplicate = array();
                          echo '<div class="ms-pop">
                          <hr>
                            <br>
                            <div class="choice-box">
                            <div class="m_p_container re-pos-top" id="bDon_container"><h1 class="normal-text centerize m_p_text">Comparable to
                            </h1>
                            <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowT1['name'] ).'"class="img-thumnail round-img lefted-imgC boredered" id="bDon_img" /> </div>
                            </div>
                            <br>
                              <ul>
                              ';
                          while ($rowTD = mysqli_fetch_array($resultTD)) {
                            if (in_array($rowTD["organization_name"] ,$dupplicate)){

                            }else {
                              echo '
                                <a href="check.org.php?o=' . ucwords($rowTD["organization_name"]) .'"><li>
                                  <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowTD['name'] ).'"class="img-thumnail round-img" /> </div>
                                  <p class="d_text-row">Donated: <span>$'.$rowTD["donation"].'</span></p>
                                </li></a>';
                                $dupplicate[] = $rowTD["organization_name"];
                            }
                          }
                          echo '
                          </ul>
                          </div>
                          </div>';
                        }
                      }
                   }
                 }
              }
              $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
               ORDER BY all_organizations.donation DESC"; // CHANGE LATER (likes and DONATIONS)
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: mainpage.php?errorS=sqlerror");
                exit();
              }else{
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck <= 0) {
                  header("Location: mainpage.php?error=noresult");
                  exit();
                }else{
                  $MsDnRd = array();
                  $limited = 1;
                  $orderDn = 1;

                  while(count($MsDnRd) < 5){
                    $i = rand(1, 8);
                    if (!in_array($i ,$MsDnRd)) {
                      $MsDnRd[] = $i;
                    }
                  }

                  $result = mysqli_query($conn,$sql);
                  echo '<div class="ms-pop">
                  <hr>
                    <br>
                    <div class="choice-box">
                    <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Donated</h1></div>
                    <br>
                      <ul>

                      ';
                while($row = mysqli_fetch_array($result)){
                  if (in_array($orderDn ,$MsDnRd) && $limited <= 5) {
                    echo '
                         <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                         <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                         <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                       </li></a>';
                       $limited++;
                    }
                    $orderDn++;
                  }
                  echo '
                  </ul>
                </div>
              </div>';
                }
              }

              // END of TRAMSACTION SUGGESTIONS
            }
          }
        }else {
          $resultOC = mysqli_query($conn,$sqlC);


          // "all the world"
          $count_loc = 0;

          // poverty
          $count_fight = 0;
          // hunger
          $count_fight2 = 0;
          // hunger&poverty
          $count_fight3 = 0;
          // disease
          $count_fight4 = 0;
          // abusation
          $count_fight5 = 0;

          // large
          $count_type = 0;
          // medium
          $count_type2 = 0;
          // small
          $count_type3 = 0;

          $loc = array();
          $fight = array();
          $type = array();
          $Cartadded = array();


          while($row = mysqli_fetch_array($resultOC)){

             $loc[] = $row["organization_location"];
             $fight[] = $row["organization_fight"];
             $type[] = $row["organization_type"];

             $Cartadded[] = $row["organization_name"];
          }



          foreach ($loc as $key => $value) {
            if ($value == "all the world") {
              $count_loc++;
            }
          }

          foreach ($fight as $key => $value) {
            if ($value == "poverty") {
              $count_fight++;
            }else if ($value == "hunger") {
              $count_fight2++;
            }else if ($value == "hunger&poverty") {
              $count_fight3++;
            }else if ($value == "disease") {
              $count_fight4++;
            }else if ($value == "abusation") {
              $count_fight5++;
            }
          }

          foreach ($type as $key => $value) {
            if ($value == "large") {
              $count_type++;
            }else if ($value == "medium") {
              $count_type2++;
            }else if ($value == "small") {
              $count_type3++;
            }else {
              // Default $value = large
              $count_type++;
            }
          }
          // GET FIGHT, LOCATION AND TYPE NY NUMBER


          // echo "
          // // all the world
          // $count_loc;
          //
          // // poverty
          // $count_fight;
          // // hunger
          // $count_fight2;
          // // hunger&poverty
          // $count_fight3;
          // // disease
          // $count_fight4;
          // // abusation
          // $count_fight5;
          //
          // // large
          // $count_type;
          // // medium
          // $count_type2;
          // // small
          // $count_type3//<br><br>
          // ";

          $top_loc_value = max(0,$count_loc);

          $top_fight_value = max($count_fight, $count_fight2,$count_fight3,$count_fight4,$count_fight5);

          $top_type_value = max($count_type, $count_type2, $count_type3);

          // get highest fight choosen

          if ($top_fight_value == $count_fight && $top_fight_value == $count_fight2) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "poverty";
            }else{
              $fight_name = "hunger";
            }
          }else if($top_fight_value == $count_fight && $top_fight_value == $count_fight3){
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "poverty";
            }else{
              $fight_name = "hunger&poverty";
            }
          }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight4) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "poverty";
            }else{
              $fight_name = "disease";
            }
          }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight5) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "poverty";
            }else{
              $fight_name = "abusation";
            }
          }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight3) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "hunger";
            }else{
              $fight_name = "hunger&poverty";
            }
          }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight4) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "hunger";
            }else{
              $fight_name = "disease";
            }
          }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight5) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "hunger";
            }else{
              $fight_name = "abusation";
            }
          }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight4) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "hunger&poverty";
            }else{
              $fight_name = "disease";
            }
          }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight5) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "hunger&poverty";
            }else{
              $fight_name = "abusation";
            }
          }else if ($top_fight_value == $count_fight4 && $top_fight_value == $count_fight5) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $fight_name = "disease";
            }else{
              $fight_name = "abusation";
            }
          }else {
            if ($top_fight_value == $count_fight) {
              $fight_name = "poverty";
            }else if ($top_fight_value == $count_fight2) {
              $fight_name = "hunger";
            }else if ($top_fight_value == $count_fight3) {
              $fight_name = "hunger&poverty";
            }else if ($top_fight_value == $count_fight4) {
              $fight_name = "disease";
            }else {
              $fight_name = "abusation";
            }
          }

          // get highest type choosen between 2 by rand()

          if ($top_type_value == $count_type && $top_type_value == $count_type2) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $type_name = "large";
            }else{
              $type_name = "medium";
            }
          }else if($top_type_value == $count_type && $top_type_value == $count_type3){
            $rand = rand(1,2);
            if ($rand == 1) {
              $type_name = "large";
            }else{
              $type_name = "small";
            }
          }else if ($top_type_value == $count_type2 && $top_type_value == $count_type3) {
            $rand = rand(1,2);
            if ($rand == 1) {
              $type_name = "medium";
            }else{
              $type_name = "small";
            }
          }else {
            if ($top_type_value == $count_type) {
              $type_name = "large";
            }else if ($top_type_value == $count_type2) {
              $type_name = "medium";
            }else {
              $type_name = "small";
            }
          }
          // end of highest type choosen by rand()
          $org_loc_sql = 'all the world';
          $sqlRelated = "SELECT * FROM all_organizations,organizations_img WHERE
          ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name')
           AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))

          OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
           (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
          OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
          (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
          OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
           (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
          OR ((all_organizations.organization_location='$org_loc_sql') AND
           (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
          OR ((all_organizations.organization_fight='$fight_name') AND
           (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
          OR ((all_organizations.organization_type='$type_name') AND
           (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' )) ORDER BY RAND() LIMIT 5";
           $stmtFRelated = mysqli_stmt_init($conn);
           $result = mysqli_query($conn,$sqlRelated);

           if (!mysqli_stmt_prepare($stmtFRelated,$sqlRelated)) {
             header("Location: mainpage.php?errorS=sqlerror");
             exit();
           }else{
             mysqli_stmt_execute($stmtFRelated);
             mysqli_stmt_store_result($stmtFRelated);
             $resultCheck = mysqli_stmt_num_rows($stmtFRelated);
             if ($resultCheck <= 0) {

             }else {
               echo '<div class="ms-pop">
                 <br>
                 <div class="choice-box">
                 <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommandations</h1></div>
                 <br>
                   <ul>';
               while($row = mysqli_fetch_array($result)){
               echo '
                   <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                   <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                   <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

                 </li></a>';
               }
               echo '
               </ul>
               </div>
               </div>';
             }
           }
           $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
            ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
           $stmt = mysqli_stmt_init($conn);
           if (!mysqli_stmt_prepare($stmt,$sql)) {
             header("Location: mainpage.php?errorS=sqlerror");
             exit();
           }else{
             mysqli_stmt_execute($stmt);
             mysqli_stmt_store_result($stmt);
             $resultCheck = mysqli_stmt_num_rows($stmt);
             if ($resultCheck <= 0) {
               header("Location: mainpage.php?error=noresult");
               exit();
             }else{
               $i = 1;
               $result = mysqli_query($conn,$sql);
               echo '<div class="ms-pop">
               <hr>
                 <br>
                 <div class="choice-box">
                 <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>
                 <br>
                   <ul>

                   ';
             while($row = mysqli_fetch_array($result)){
              echo '
                   <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                   <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                   <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                 </li></a>';
               }
               echo '
               </ul>
             </div>
           </div>';
             }
           }
           $sqlC = "SELECT * FROM user_cart, all_organizations, organizations_img WHERE (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id AND (LOWER(REPLACE(all_organizations.organization_name,' ', ''))=LOWER(REPLACE(organizations_img.organization_name,' ', '')))) ORDER BY RAND() LIMIT 1";
           $stmtC = mysqli_stmt_init($conn);
           $resultC1 = mysqli_query($conn,$sqlC);

           if (!mysqli_stmt_prepare($stmtC,$sqlC)) {
             header("Location: mainpage.php?errorS=sqlerror");
             exit();
           }else{
             mysqli_stmt_execute($stmtC);
             mysqli_stmt_store_result($stmtC);
             $resultCheckC = mysqli_stmt_num_rows($stmtC);
             if ($resultCheckC <= 0) {
             }else {
               while ($rowC1 = mysqli_fetch_array($resultC1)) {

                 $l = $rowC1["organization_location"];
                 $f = $rowC1["organization_fight"];
                 $t = $rowC1["organization_type"];

                 $slqCW = "SELECT * FROM user_cart ,all_organizations,organizations_img WHERE
                 ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t')
                  AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))

                 OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND
                  (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
                 OR ((all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t') AND
                 (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
                 OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_type='$t') AND
                  (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
                 OR ((all_organizations.organization_location='$l') AND
                  (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
                 OR ((all_organizations.organization_fight='$f') AND
                  (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
                 OR ((all_organizations.organization_type='$t') AND
                  (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' )) ORDER BY RAND() LIMIT 5";
                  $stmtCW = mysqli_stmt_init($conn);
                  $resultCW = mysqli_query($conn,$slqCW);

                  if (!mysqli_stmt_prepare($stmtCW,$slqCW)) {
                    header("Location: mainpage.php?errorS=sqlerror");
                    exit();
                  }else{
                    mysqli_stmt_execute($stmtCW);
                    mysqli_stmt_store_result($stmtCW);
                    $resultCheck = mysqli_stmt_num_rows($stmtCW);
                    if ($resultCheck <= 0) {

                    }else {
                      $dupplicate = array();
                      echo '<div class="ms-pop">
                      <hr>
                        <br>
                        <div class="choice-box">
                        <div class="m_p_container" id="blike_container"><h1 class="normal-text centerize m_p_text">Because you watched
                        </h1>
                        <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowC1['name'] ).'"class="img-thumnail round-img lefted-img boredered" id="blike_img" /> </div>
                        </div>
                        <br><ul>';
                      while ($rowCW = mysqli_fetch_array($resultCW)) {
                        if (in_array($rowCW["organization_name"] ,$dupplicate)){

                        }else {
                          echo '
                            <a href="check.org.php?o=' . ucwords($rowCW["organization_name"]) .'"><li>
                              <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowCW['name'] ).'"class="img-thumnail round-img" /> </div>
                              <p class="d_text-row">Donated: <span>$'.$rowCW["donation"].'</span></p>
                            </li></a>';
                            $dupplicate[] = $rowCW["organization_name"];
                        }
                      }
                      echo '
                      </ul>
                      </div>
                      </div>';
                    }
                  }
               }
             }
          }
          $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
           ORDER BY all_organizations.donation DESC"; // CHANGE LATER (likes and DONATIONS)
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: mainpage.php?errorS=sqlerror");
            exit();
          }else{
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck <= 0) {
              header("Location: mainpage.php?error=noresult");
              exit();
            }else{
              $MsDnRd = array();
              $limited = 1;
              $orderDn = 1;

              while(count($MsDnRd) < 5){
                $i = rand(1, 8);
                if (!in_array($i ,$MsDnRd)) {
                  $MsDnRd[] = $i;
                }
              }

              $result = mysqli_query($conn,$sql);
              echo '<div class="ms-pop">
              <hr>
                <br>
                <div class="choice-box">
                <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Donated</h1></div>
                <br>
                  <ul>

                  ';
            while($row = mysqli_fetch_array($result)){
              if (in_array($orderDn ,$MsDnRd) && $limited <= 5) {
                echo '
                     <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                     <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                     <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>


                   </li></a>';
                   $limited++;
                }
                $orderDn++;
              }
              echo '
              </ul>
            </div>
          </div>';
            }
          }
           // END of CART SUGGESTIONS
        }
      }









    }else {
      // Related to your Donations
      $slqT = "SELECT * FROM transactions, all_organizations WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) ORDER BY RAND()";
      $stmtT = mysqli_stmt_init($conn);

      $resultT1 = mysqli_query($conn,$slqT);

      if (!mysqli_stmt_prepare($stmtT,$slqT)) {
        header("Location: mainpage.php?errorS=sqlerror");
        exit();
      }else{
        mysqli_stmt_execute($stmtT);
        mysqli_stmt_store_result($stmtT);
        $resultCheckT = mysqli_stmt_num_rows($stmtT);

        // Did not donated or nothing in cart
        if ($resultCheckT <= 0) {
        }else {
          $OrgDon = array();
          while ($rowT1 = mysqli_fetch_array($resultT1)) {
            $OrgDon[] = $rowT1["organization_name"];
          }
        }
      }
      $sqlC = "SELECT * FROM user_cart, all_organizations WHERE (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id) ORDER BY RAND()";
      $stmtC = mysqli_stmt_init($conn);

      $resultC1 = mysqli_query($conn,$sqlC);

      if (!mysqli_stmt_prepare($stmtC,$sqlC)) {
        header("Location: mainpage.php?errorS=sqlerror");
        exit();
      }else{
        mysqli_stmt_execute($stmtC);
        mysqli_stmt_store_result($stmtC);
        $resultCheckC = mysqli_stmt_num_rows($stmtC);

        // NOTHING IN CART
        if ($resultCheckC <= 0) {




        }else {
          $Cartadded = array();
          while ($rowC1 = mysqli_fetch_array($resultC1)) {
            $Cartadded[] = $rowC1["organization_name"];
          }

        }
      }


      // start of ALL WATCHED ORGANIZATIONS RECOMMANDATIONS FINDING
      $resultF = mysqli_query($conn,$sqlFull);


      // "all the world"
      $count_loc = 0;

      // poverty
      $count_fight = 0;
      // hunger
      $count_fight2 = 0;
      // hunger&poverty
      $count_fight3 = 0;
      // disease
      $count_fight4 = 0;
      // abusation
      $count_fight5 = 0;

      // large
      $count_type = 0;
      // medium
      $count_type2 = 0;
      // small
      $count_type3 = 0;

      $loc = array();
      $fight = array();
      $type = array();
      $All_Wtch_organizations = array();

      while($row = mysqli_fetch_array($resultF)){

         $loc[] = $row["organization_location"];
         $fight[] = $row["organization_fight"];
         $type[] = $row["organization_type"];

         $All_WtchNDon_organizations[] = $row["organization_name"];
      }



      foreach ($loc as $key => $value) {
        if ($value == "all the world") {
          $count_loc++;
        }
      }

      foreach ($fight as $key => $value) {
        if ($value == "poverty") {
          $count_fight++;
        }else if ($value == "hunger") {
          $count_fight2++;
        }else if ($value == "hunger&poverty") {
          $count_fight3++;
        }else if ($value == "disease") {
          $count_fight4++;
        }else if ($value == "abusation") {
          $count_fight5++;
        }
      }

      foreach ($type as $key => $value) {
        if ($value == "large") {
          $count_type++;
        }else if ($value == "medium") {
          $count_type2++;
        }else if ($value == "small") {
          $count_type3++;
        }else {
          // Default $value = large
          $count_type++;
        }
      }
      // GET FIGHT, LOCATION AND TYPE NY NUMBER


      // echo "
      // // all the world
      // $count_loc;
      //
      // // poverty
      // $count_fight;
      // // hunger
      // $count_fight2;
      // // hunger&poverty
      // $count_fight3;
      // // disease
      // $count_fight4;
      // // abusation
      // $count_fight5;
      //
      // // large
      // $count_type;
      // // medium
      // $count_type2;
      // // small
      // $count_type3//<br><br>
      // ";

      $top_loc_value = max(0,$count_loc);

      $top_fight_value = max($count_fight, $count_fight2,$count_fight3,$count_fight4,$count_fight5);

      $top_type_value = max($count_type, $count_type2, $count_type3);

      // get highest fight choosen

      if ($top_fight_value == $count_fight && $top_fight_value == $count_fight2) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "poverty";
        }else{
          $fight_name = "hunger";
        }
      }else if($top_fight_value == $count_fight && $top_fight_value == $count_fight3){
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "poverty";
        }else{
          $fight_name = "hunger&poverty";
        }
      }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight4) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "poverty";
        }else{
          $fight_name = "disease";
        }
      }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight5) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "poverty";
        }else{
          $fight_name = "abusation";
        }
      }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight3) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "hunger";
        }else{
          $fight_name = "hunger&poverty";
        }
      }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight4) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "hunger";
        }else{
          $fight_name = "disease";
        }
      }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight5) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "hunger";
        }else{
          $fight_name = "abusation";
        }
      }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight4) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "hunger&poverty";
        }else{
          $fight_name = "disease";
        }
      }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight5) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "hunger&poverty";
        }else{
          $fight_name = "abusation";
        }
      }else if ($top_fight_value == $count_fight4 && $top_fight_value == $count_fight5) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $fight_name = "disease";
        }else{
          $fight_name = "abusation";
        }
      }else {
        if ($top_fight_value == $count_fight) {
          $fight_name = "poverty";
        }else if ($top_fight_value == $count_fight2) {
          $fight_name = "hunger";
        }else if ($top_fight_value == $count_fight3) {
          $fight_name = "hunger&poverty";
        }else if ($top_fight_value == $count_fight4) {
          $fight_name = "disease";
        }else {
          $fight_name = "abusation";
        }
      }

      // get highest type choosen between 2 by rand()

      if ($top_type_value == $count_type && $top_type_value == $count_type2) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $type_name = "large";
        }else{
          $type_name = "medium";
        }
      }else if($top_type_value == $count_type && $top_type_value == $count_type3){
        $rand = rand(1,2);
        if ($rand == 1) {
          $type_name = "large";
        }else{
          $type_name = "small";
        }
      }else if ($top_type_value == $count_type2 && $top_type_value == $count_type3) {
        $rand = rand(1,2);
        if ($rand == 1) {
          $type_name = "medium";
        }else{
          $type_name = "small";
        }
      }else {
        if ($top_type_value == $count_type) {
          $type_name = "large";
        }else if ($top_type_value == $count_type2) {
          $type_name = "medium";
        }else {
          $type_name = "small";
        }
      }
      // end of highest type choosen by rand()
      $org_loc_sql = 'all the world';
      $sqlRelated = "SELECT * FROM all_organizations,organizations_img WHERE
      ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name')
       AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' ))

      OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
       (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' ))
      OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' ))
      OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
       (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' ))
      OR ((all_organizations.organization_location='$org_loc_sql') AND
       (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' ))
      OR ((all_organizations.organization_fight='$fight_name') AND
       (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' ))
      OR ((all_organizations.organization_type='$type_name') AND
       (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_WtchNDon_organizations ) . "' )) ORDER BY RAND() LIMIT 5";
       $stmtFRelated = mysqli_stmt_init($conn);
       $result = mysqli_query($conn,$sqlRelated);

       if (!mysqli_stmt_prepare($stmtFRelated,$sqlRelated)) {
         header("Location: mainpage.php?errorS=sqlerror");
         exit();
       }else{
         mysqli_stmt_execute($stmtFRelated);
         mysqli_stmt_store_result($stmtFRelated);
         $resultCheck = mysqli_stmt_num_rows($stmtFRelated);
         if ($resultCheck <= 0) {

         }else {
           echo '<div class="ms-pop">
             <br>
             <div class="choice-box">
             <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommandations</h1></div>
             <br>

               <ul>';
           while($row = mysqli_fetch_array($result)){
           echo '
               <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
               <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
               <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

             </li></a>';
           }
           echo '
           </ul>
           </div>
           </div>';
         }
       }
       $sqlC = "SELECT * FROM user_cart, all_organizations, organizations_img WHERE (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id AND (LOWER(REPLACE(all_organizations.organization_name,' ', ''))=LOWER(REPLACE(organizations_img.organization_name,' ', '')))) ORDER BY RAND() LIMIT 1";
       $stmtC = mysqli_stmt_init($conn);
       $resultC1 = mysqli_query($conn,$sqlC);

       if (!mysqli_stmt_prepare($stmtC,$sqlC)) {
         header("Location: mainpage.php?errorS=sqlerror");
         exit();
       }else{
         mysqli_stmt_execute($stmtC);
         mysqli_stmt_store_result($stmtC);
         $resultCheckC = mysqli_stmt_num_rows($stmtC);
         if ($resultCheckC <= 0) {
         }else {
           while ($rowC1 = mysqli_fetch_array($resultC1)) {

             $l = $rowC1["organization_location"];
             $f = $rowC1["organization_fight"];
             $t = $rowC1["organization_type"];

             $slqCW = "SELECT * FROM user_cart ,all_organizations,organizations_img WHERE
             ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t')
              AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))

             OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
             OR ((all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
             OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_type='$t') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
             OR ((all_organizations.organization_location='$l') AND
              (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
             OR ((all_organizations.organization_fight='$f') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' ))
             OR ((all_organizations.organization_type='$t') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $Cartadded ) . "' )) ORDER BY RAND() LIMIT 5";
              $stmtCW = mysqli_stmt_init($conn);
              $resultCW = mysqli_query($conn,$slqCW);

              if (!mysqli_stmt_prepare($stmtCW,$slqCW)) {
                header("Location: mainpage.php?errorS=sqlerror");
                exit();
              }else{
                mysqli_stmt_execute($stmtCW);
                mysqli_stmt_store_result($stmtCW);
                $resultCheck = mysqli_stmt_num_rows($stmtCW);
                if ($resultCheck <= 0) {

                }else {
                  $dupplicate = array();
                  echo '<div class="ms-pop">
                  <hr>
                    <br>
                    <div class="choice-box">
                    <div class="m_p_container" id="blike_container"><h1 class="normal-text centerize m_p_text">Because you watched
                    </h1>
                    <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowC1['name'] ).'"class="img-thumnail round-img lefted-img boredered" id="blike_img" /> </div>
                    </div>
                    <br>

                      <ul>
                      ';
                  while ($rowCW = mysqli_fetch_array($resultCW)) {
                    if (in_array($rowCW["organization_name"] ,$dupplicate)){

                    }else {
                      echo '
                        <a href="check.org.php?o=' . ucwords($rowCW["organization_name"]) .'"><li>
                          <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowCW['name'] ).'"class="img-thumnail round-img" /> </div>
                          <p class="d_text-row">Donated: <span>$'.$rowCW["donation"].'</span></p>
                        </li></a>';
                        $dupplicate[] = $rowCW["organization_name"];
                    }
                  }
                  echo '
                  </ul>
                  </div>
                  </div>';
                }
              }
           }
         }
      }

      $slqTA = "SELECT * FROM transactions, all_organizations WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) ORDER BY RAND()";
      $stmtTA = mysqli_stmt_init($conn);

      $resultTA = mysqli_query($conn,$slqTA);

      if (!mysqli_stmt_prepare($stmtTA,$slqTA)) {
        header("Location: mainpage.php?errorS=sqlerror");
        exit();
      }else{
        mysqli_stmt_execute($stmtTA);
        mysqli_stmt_store_result($stmtTA);
        $resultCheckT = mysqli_stmt_num_rows($stmtTA);
        if ($resultCheckT <= 0) {
        }else {
            // "all the world"
            $count_loc = 0;

            // poverty
            $count_fight = 0;
            // hunger
            $count_fight2 = 0;
            // hunger&poverty
            $count_fight3 = 0;
            // disease
            $count_fight4 = 0;
            // abusation
            $count_fight5 = 0;

            // large
            $count_type = 0;
            // medium
            $count_type2 = 0;
            // small
            $count_type3 = 0;

            $loc = array();
            $fight = array();
            $type = array();
            $All_Don_organizations = array();

            while($row = mysqli_fetch_array($resultTA)){

               $loc[] = $row["organization_location"];
               $fight[] = $row["organization_fight"];
               $type[] = $row["organization_type"];

               $All_Don_organizations[] = $row["organization_name"];
            }



            foreach ($loc as $key => $value) {
              if ($value == "all the world") {
                $count_loc++;
              }
            }

            foreach ($fight as $key => $value) {
              if ($value == "poverty") {
                $count_fight++;
              }else if ($value == "hunger") {
                $count_fight2++;
              }else if ($value == "hunger&poverty") {
                $count_fight3++;
              }else if ($value == "disease") {
                $count_fight4++;
              }else if ($value == "abusation") {
                $count_fight5++;
              }
            }

            foreach ($type as $key => $value) {
              if ($value == "large") {
                $count_type++;
              }else if ($value == "medium") {
                $count_type2++;
              }else if ($value == "small") {
                $count_type3++;
              }else {
                // Default $value = large
                $count_type++;
              }
            }
            // GET FIGHT, LOCATION AND TYPE NY NUMBER


            // echo "
            // // all the world
            // $count_loc;
            //
            // // poverty
            // $count_fight;
            // // hunger
            // $count_fight2;
            // // hunger&poverty
            // $count_fight3;
            // // disease
            // $count_fight4;
            // // abusation
            // $count_fight5;
            //
            // // large
            // $count_type;
            // // medium
            // $count_type2;
            // // small
            // $count_type3//<br><br>
            // ";

            $top_loc_value = max(0,$count_loc);

            $top_fight_value = max($count_fight, $count_fight2,$count_fight3,$count_fight4,$count_fight5);

            $top_type_value = max($count_type, $count_type2, $count_type3);

            // get highest fight choosen

            if ($top_fight_value == $count_fight && $top_fight_value == $count_fight2) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "poverty";
              }else{
                $fight_name = "hunger";
              }
            }else if($top_fight_value == $count_fight && $top_fight_value == $count_fight3){
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "poverty";
              }else{
                $fight_name = "hunger&poverty";
              }
            }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight4) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "poverty";
              }else{
                $fight_name = "disease";
              }
            }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight5) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "poverty";
              }else{
                $fight_name = "abusation";
              }
            }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight3) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "hunger";
              }else{
                $fight_name = "hunger&poverty";
              }
            }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight4) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "hunger";
              }else{
                $fight_name = "disease";
              }
            }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight5) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "hunger";
              }else{
                $fight_name = "abusation";
              }
            }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight4) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "hunger&poverty";
              }else{
                $fight_name = "disease";
              }
            }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight5) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "hunger&poverty";
              }else{
                $fight_name = "abusation";
              }
            }else if ($top_fight_value == $count_fight4 && $top_fight_value == $count_fight5) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $fight_name = "disease";
              }else{
                $fight_name = "abusation";
              }
            }else {
              if ($top_fight_value == $count_fight) {
                $fight_name = "poverty";
              }else if ($top_fight_value == $count_fight2) {
                $fight_name = "hunger";
              }else if ($top_fight_value == $count_fight3) {
                $fight_name = "hunger&poverty";
              }else if ($top_fight_value == $count_fight4) {
                $fight_name = "disease";
              }else {
                $fight_name = "abusation";
              }
            }

            // get highest type choosen between 2 by rand()

            if ($top_type_value == $count_type && $top_type_value == $count_type2) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $type_name = "large";
              }else{
                $type_name = "medium";
              }
            }else if($top_type_value == $count_type && $top_type_value == $count_type3){
              $rand = rand(1,2);
              if ($rand == 1) {
                $type_name = "large";
              }else{
                $type_name = "small";
              }
            }else if ($top_type_value == $count_type2 && $top_type_value == $count_type3) {
              $rand = rand(1,2);
              if ($rand == 1) {
                $type_name = "medium";
              }else{
                $type_name = "small";
              }
            }else {
              if ($top_type_value == $count_type) {
                $type_name = "large";
              }else if ($top_type_value == $count_type2) {
                $type_name = "medium";
              }else {
                $type_name = "small";
              }
            }
            // end of highest type choosen by rand()

            $org_loc_sql = 'all the world';
            $sqlRelatedTA = "SELECT * FROM all_organizations,organizations_img WHERE
            ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name')
             AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' ))

            OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' ))
            OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
            (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' ))
            OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' ))
            OR ((all_organizations.organization_location='$org_loc_sql') AND
             (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' ))
            OR ((all_organizations.organization_fight='$fight_name') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' ))
            OR ((all_organizations.organization_type='$type_name') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Don_organizations ) . "' )) ORDER BY RAND() LIMIT 5";
             $stmtTARelated = mysqli_stmt_init($conn);
             $result = mysqli_query($conn,$sqlRelatedTA);

             if (!mysqli_stmt_prepare($stmtTARelated,$sqlRelatedTA)) {
               header("Location: mainpage.php?errorS=sqlerror");
               exit();
             }else{
               mysqli_stmt_execute($stmtTARelated);
               mysqli_stmt_store_result($stmtTARelated);
               $resultCheck = mysqli_stmt_num_rows($stmtTARelated);
               if ($resultCheck <= 0) {

               }else {
                 echo '<div class="ms-pop">
                 <hr>
                   <br>
                   <div class="choice-box">
                   <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Related to your Donations</h1></div>
                   <br>

                     <ul>';
                 while($row = mysqli_fetch_array($result)){
                 echo '
                     <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                     <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                     <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

                   </li></a>';
                 }
                 echo '
                 </ul>
                 </div>
                 </div>';
               }
             }
        }
      }
      $sqlT = "SELECT * FROM transactions, all_organizations, organizations_img WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id AND (LOWER(REPLACE(all_organizations.organization_name,' ', ''))=LOWER(REPLACE(organizations_img.organization_name,' ', '')))) ORDER BY RAND() LIMIT 1";
      $stmtT = mysqli_stmt_init($conn);
      $resultT1 = mysqli_query($conn,$sqlT);

      if (!mysqli_stmt_prepare($stmtT,$sqlT)) {
        header("Location: mainpage.php?errorS=sqlerror");
        exit();
      }else{
        mysqli_stmt_execute($stmtT);
        mysqli_stmt_store_result($stmtT);
        $resultCheckT = mysqli_stmt_num_rows($stmtT);
        if ($resultCheckT <= 0) {
        }else {
          while ($rowT1 = mysqli_fetch_array($resultT1)) {

            $l = $rowT1["organization_location"];
            $f = $rowT1["organization_fight"];
            $t = $rowT1["organization_type"];

            $slqTD = "SELECT * FROM all_organizations,organizations_img WHERE
            ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t')
             AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))

            OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_fight='$f') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
            OR ((all_organizations.organization_fight='$f') AND (all_organizations.organization_type='$t') AND
            (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
            OR ((all_organizations.organization_location='$l') AND (all_organizations.organization_type='$t') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
            OR ((all_organizations.organization_location='$l') AND
             (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
            OR ((all_organizations.organization_fight='$f') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' ))
            OR ((all_organizations.organization_type='$t') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $OrgDon ) . "' )) ORDER BY RAND() LIMIT 5";
             $stmtTD = mysqli_stmt_init($conn);
             $resultTD = mysqli_query($conn,$slqTD);

             if (!mysqli_stmt_prepare($stmtTD,$slqTD)) {
               header("Location: mainpage.php?errorS=sqlerror");
               exit();
             }else{
               mysqli_stmt_execute($stmtTD);
               mysqli_stmt_store_result($stmtTD);
               $resultCheck = mysqli_stmt_num_rows($stmtTD);
               if ($resultCheck <= 0) {

               }else {
                 $dupplicate = array();
                 echo '<div class="ms-pop">
                 <hr>
                   <br>
                   <div class="choice-box">
                   <div class="m_p_container" id="bDon_container"><h1 class="normal-text centerize m_p_text">Comparable to
                   </h1>
                   <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowT1['name'] ).'"class="img-thumnail round-img lefted-imgC boredered" id="bDon_img" /> </div>
                   </div>
                   <br>

                     <ul>
                     ';
                 while ($rowTD = mysqli_fetch_array($resultTD)) {
                   if (in_array($rowTD["organization_name"] ,$dupplicate)){

                   }else {
                     echo '
                       <a href="check.org.php?o=' . ucwords($rowTD["organization_name"]) .'"><li>
                         <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowTD['name'] ).'"class="img-thumnail round-img" /> </div>
                         <p class="d_text-row">Donated: <span>$'.$rowTD["donation"].'</span></p>
                       </li></a>';
                       $dupplicate[] = $rowTD["organization_name"];
                   }
                 }
                 echo '
                 </ul>
                 </div>
                 </div>';
               }
             }
          }
        }
     }
    }
  }
}
 ?>

<script type="text/javascript">
var img = document.getElementById('blike_img');

var width = img.clientWidth;
var height = img.clientHeight;
var separation = 22;
var spaceimg = 18;
var finalimg_top = height - spaceimg;
var finalheightb = -height - separation;
document.getElementById("blike_container").style.marginBottom = finalheightb + "px";
document.getElementById("blike_img").style.top = -finalimg_top + "px";

var imgD = document.getElementById('bDon_img');

var widthD = imgD.clientWidth;
var heightD = imgD.clientHeight;
var separationD = 22;
var spaceimgD = 18;
var finalimg_topD = heightD - spaceimgD;
var finalheightbD = -heightD - separationD;
document.getElementById("bDon_container").style.marginBottom = finalheightbD + "px";
document.getElementById("bDon_img").style.top = -finalimg_topD + "px";

</script>


<!-- echo '<div class="ms-pop">
  <br>
  <div class="choice-box">
  <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>

    <ul>

    ';
while($rowM = mysqli_fetch_array($resultM)){
echo '
    <a href="check.org.php?o=' . ucwords($rowM["organization_name"]) .'"><li>
    <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowM['name'] ).'"class="img-thumnail round-img" /> </div>
    <p class="d_text-row">Donated: <span>$'.$rowM["donation"].'</span></p>


  </li></a>';
}
echo '
</ul>
</div>
</div>'; -->



 <!-- 2 -->
<!-- echo '<div class="liked_suggestion">
  <br>
  <div class="choice-box">
  <div class="m_p_container" id="blike_container"><h1 class="normal-text centerize m_p_text">Related to
  </h1>
  <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowRealtedP2['name'] ).'"class="img-thumnail round-img"id="blike_img" /> </div>
  </div>
    <ul>
    ';
while ($rowRealtedBLiked = mysqli_fetch_array($resultRelatedBLiked)) {
  $ox = $rowRealtedBLiked['organization_name'];
  $oz = $rowRealtedP2['organization_name'];

  echo '
       <a href="check.org.php?o=' . ucwords($rowRealtedBLiked["organization_name"]) .'"><li>
       <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowRealtedBLiked['name'] ).'"class="img-thumnail round-img" /> </div>
       <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

     </li></a>';
}
echo '
</ul>
</div>
</div>'; -->























<!--
$m_show = false;
$M2 = false;

$sql = "SELECT * FROM user_cart, transactions, all_organizations WHERE ((transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id AND user_cart.organization_id = all_organizations.organization_id)) ORDER BY RAND() LIMIT 1";
$stmt = mysqli_stmt_init($conn);

$sqlT = "SELECT * FROM transactions, all_organizations (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) ORDER BY RAND() LIMIT 1";
$stmtT = mysqli_stmt_init($conn);

$sqlCart = "SELECT * FROM user_cart, all_organizations WHERE (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id)";

$stmtCart = mysqli_stmt_init($conn);

$liked_organizations = array();

$sql2 = "SELECT * FROM user_cart, transactions, all_organizations WHERE ((transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id AND user_cart.organization_id = all_organizations.organization_id)
OR (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) OR (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id))";
$stmt2 = mysqli_stmt_init($conn);


if (!mysqli_stmt_prepare($stmt,$sql)) {
  header("Location: mainpage.php?errorS=sqlerror");
  exit();
}else{
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $resultCheck = mysqli_stmt_num_rows($stmt);
  if ($resultCheck <= 0) {

  }else{
    $i = 1;
    $result = mysqli_query($conn,$sql);

    $result2 = mysqli_query($conn,$sql2);

    // start of ALL WATCHED ORGANIZATIONS RECOMMANDATIONS FINDING

    // "all the world"
    $count_loc = 0;

    // poverty
    $count_fight = 0;
    // hunger
    $count_fight2 = 0;
    // hunger&poverty
    $count_fight3 = 0;
    // disease
    $count_fight4 = 0;
    // abusation
    $count_fight5 = 0;

    // large
    $count_type = 0;
    // medium
    $count_type2 = 0;
    // small
    $count_type3 = 0;

    $loc = array();
    $fight = array();
    $type = array();
    $All_Wtch_organizations = array();

    while($row2 = mysqli_fetch_array($result2)){

       $loc[] = $row2["organization_location"];
       $fight[] = $row2["organization_fight"];
       $type[] = $row2["organization_type"];

       $All_Wtch_organizations[] = $row2["organization_name"];
    }



    foreach ($loc as $key => $value) {
      if ($value == "all the world") {
        $count_loc++;
      }
    }

    foreach ($fight as $key => $value) {
      if ($value == "poverty") {
        $count_fight++;
      }else if ($value == "hunger") {
        $count_fight2++;
      }else if ($value == "hunger&poverty") {
        $count_fight3++;
      }else if ($value == "disease") {
        $count_fight4++;
      }else if ($value == "abusation") {
        $count_fight5++;
      }
    }

    foreach ($type as $key => $value) {
      if ($value == "large") {
        $count_type++;
      }else if ($value == "medium") {
        $count_type2++;
      }else if ($value == "small") {
        $count_type3++;
      }else {
        // Default $value = large
        $count_type++;
      }
    }
    // GET FIGHT, LOCATION AND TYPE NY NUMBER


    // echo "
    // // all the world
    // $count_loc;
    //
    // // poverty
    // $count_fight;
    // // hunger
    // $count_fight2;
    // // hunger&poverty
    // $count_fight3;
    // // disease
    // $count_fight4;
    // // abusation
    // $count_fight5;
    //
    // // large
    // $count_type;
    // // medium
    // $count_type2;
    // // small
    // $count_type3//<br><br>
    // ";

    $top_loc_value = max(0,$count_loc);

    $top_fight_value = max($count_fight, $count_fight2,$count_fight3,$count_fight4,$count_fight5);

    $top_type_value = max($count_type, $count_type2, $count_type3);

    // get highest fight choosen

    if ($top_fight_value == $count_fight && $top_fight_value == $count_fight2) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "poverty";
      }else{
        $fight_name = "hunger";
      }
    }else if($top_fight_value == $count_fight && $top_fight_value == $count_fight3){
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "poverty";
      }else{
        $fight_name = "hunger&poverty";
      }
    }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight4) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "poverty";
      }else{
        $fight_name = "disease";
      }
    }else if ($top_fight_value == $count_fight && $top_fight_value == $count_fight5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "poverty";
      }else{
        $fight_name = "abusation";
      }
    }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight3) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "hunger";
      }else{
        $fight_name = "hunger&poverty";
      }
    }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight4) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "hunger";
      }else{
        $fight_name = "disease";
      }
    }else if ($top_fight_value == $count_fight2 && $top_fight_value == $count_fight5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "hunger";
      }else{
        $fight_name = "abusation";
      }
    }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight4) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "hunger&poverty";
      }else{
        $fight_name = "disease";
      }
    }else if ($top_fight_value == $count_fight3 && $top_fight_value == $count_fight5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "hunger&poverty";
      }else{
        $fight_name = "abusation";
      }
    }else if ($top_fight_value == $count_fight4 && $top_fight_value == $count_fight5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_name = "disease";
      }else{
        $fight_name = "abusation";
      }
    }else {
      if ($top_fight_value == $count_fight) {
        $fight_name = "poverty";
      }else if ($top_fight_value == $count_fight2) {
        $fight_name = "hunger";
      }else if ($top_fight_value == $count_fight3) {
        $fight_name = "hunger&poverty";
      }else if ($top_fight_value == $count_fight4) {
        $fight_name = "disease";
      }else {
        $fight_name = "abusation";
      }
    }

    // get highest type choosen between 2 by rand()

    if ($top_type_value == $count_type && $top_type_value == $count_type2) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $type_name = "large";
      }else{
        $type_name = "medium";
      }
    }else if($top_type_value == $count_type && $top_type_value == $count_type3){
      $rand = rand(1,2);
      if ($rand == 1) {
        $type_name = "large";
      }else{
        $type_name = "small";
      }
    }else if ($top_type_value == $count_type2 && $top_type_value == $count_type3) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $type_name = "medium";
      }else{
        $type_name = "small";
      }
    }else {
      if ($top_type_value == $count_type) {
        $type_name = "large";
      }else if ($top_type_value == $count_type2) {
        $type_name = "medium";
      }else {
        $type_name = "small";
      }
    }

    // end of highest type choosen by rand()


   while($row = mysqli_fetch_array($result)){
     $org_name_sql = $row["organization_name"];

     $org_loc_sql = $row["organization_location"];
    $limit = false;
     // GET MOST POPULAR(RECOMMANDATIONS) OF FIGHT AND TYPE

     // echo "most popular fight = $fight_name<br>";
     // echo "most popular type = $type_name";


     if (!$limit) {
       $sqlRelated = "SELECT * FROM all_organizations,organizations_img WHERE
       ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND (all_organizations.organization_name!= '$org_name_sql')
        AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))

       OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_name!= '$org_name_sql') AND
        (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
       OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND (all_organizations.organization_name!= '$org_name_sql')  AND
       (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
       OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND (all_organizations.organization_name!= '$org_name_sql') AND
        (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
       OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_name!= '$org_name_sql')  AND
        (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
       OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_name!= '$org_name_sql')  AND
        (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
       OR ((all_organizations.organization_type='$type_name') AND (all_organizations.organization_name!= '$org_name_sql') AND
        (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' )) ORDER BY RAND() LIMIT 4";
       $resultRelated = mysqli_query($conn, $sqlRelated);

       $queryResultRelated = mysqli_num_rows($resultRelated);
       if ($queryResultRelated >= 1) {
         $i=1;

         echo '<div class="liked_suggestion">
           <br>
           <div class="choice-box">
           <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommandations</h1></div>

             <ul>
             ';

         while ($rowRealted = mysqli_fetch_array($resultRelated)) {
             echo '
                  <a href="check.org.php?o=' . ucwords($rowRealted["organization_name"]) .'"><li>
                  <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowRealted['name'] ).'"class="img-thumnail round-img" /> </div>
                  <p class="d_text-row">Donated: <span>$'.$rowRealted["donation"].'</span></p>


                </li></a>';
         }
         echo '
         </ul>
         </div>
         </div><hr>';

       }else {

       }
       // RECOMMANDATIONS continue...


       $sqlM = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
       AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $All_Wtch_organizations ) . "' ) ORDER BY RAND() LIMIT 4"; // CHANGE LATER (likes and DONATIONS)
       $stmtM = mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmtM,$sqlM)) {
         header("Location: mainpage.php?errorS=sqlerror");
         exit();
       }else{
         mysqli_stmt_execute($stmtM);
         mysqli_stmt_store_result($stmtM);
         $resultCheckM = mysqli_stmt_num_rows($stmtM);
         if ($resultCheckM <= 0) {
           if (!$m_show) {
             $sqlM = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
             $stmtM = mysqli_stmt_init($conn);
             if (!mysqli_stmt_prepare($stmtM,$sqlM)) {
               header("Location: mainpage.php?errorS=sqlerror");
               exit();
             }else{
               mysqli_stmt_execute($stmtM);
               mysqli_stmt_store_result($stmtM);
               $resultCheckM = mysqli_stmt_num_rows($stmtM);
               if ($resultCheckM <= 0) {
                 header("Location: mainpage.php?error=noresult");
                 exit();
               }else{
                 $m_show = true;
                 $i = 1;
                 $resultM = mysqli_query($conn,$sqlM);
                 echo '<div class="ms-pop">
                   <br>
                   <div class="choice-box">
                   <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>

                     <ul>

                     ';
               while($rowM = mysqli_fetch_array($resultM)){
                echo '
                     <a href="check.org.php?o=' . ucwords($rowM["organization_name"]) .'"><li>
                     <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowM['name'] ).'"class="img-thumnail round-img" /> </div>
                     <p class="d_text-row">Donated: <span>$'.$rowM["donation"].'</span></p>


                   </li></a>';
                 }
                 echo '
                 </ul>
               </div>
             </div><hr>';
             $M2 = true;
               }
             }
           }
         }else{
           $m_show = true;

           $i = 1;
           $resultM = mysqli_query($conn,$sqlM);
           echo '<div class="ms-pop">
             <br>
             <div class="choice-box">
             <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>

               <ul>

               ';
         while($rowM = mysqli_fetch_array($resultM)){
           echo '
                <a href="check.org.php?o=' . ucwords($rowM["organization_name"]) .'"><li>
                <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowM['name'] ).'"class="img-thumnail round-img" /> </div>
                <p class="d_text-row">Donated: <span>$'.$rowM["donation"].'</span></p>


              </li></a>';
           }
           echo '
           </ul>
         </div>
       </div><hr>';
       $M2 = true;

         }
       }


       // find organizations 'because you liked...'

       $sqlRelatedP2 = "SELECT * FROM all_organizations,organizations_img WHERE
       (all_organizations.organization_name = '$org_name_sql') AND (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', ''))
       ORDER BY RAND() LIMIT 1";
       $resultRelatedP2 = mysqli_query($conn, $sqlRelatedP2);

       $queryResultRelatedP2 = mysqli_num_rows($resultRelatedP2);
       if ($queryResultRelatedP2 >= 1) {

         while ($rowRealtedP2 = mysqli_fetch_array($resultRelatedP2)) {
           $v = 1;

           $o_f = $rowRealtedP2['organization_fight'];
           $o_l = $rowRealtedP2['organization_location'];
           $o_t = $rowRealtedP2['organization_type'];
           $o_n = $rowRealtedP2['organization_name'];

           // RELATED TO AN UNIQUE ORGANIZATION

           $sqlBLiked = "SELECT * FROM all_organizations,organizations_img WHERE
           ((all_organizations.organization_location='$o_l') AND (all_organizations.organization_fight='$o_f') AND (all_organizations.organization_type='$o_t') AND (all_organizations.organization_name!= '$o_n') AND
            (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))

           OR ((all_organizations.organization_location='$o_l') AND (all_organizations.organization_fight='$o_f') AND (all_organizations.organization_name!= '$o_n') AND
            (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))

           OR ((all_organizations.organization_fight='$o_f') AND (all_organizations.organization_type='$o_t') AND (all_organizations.organization_name!= '$o_n')  AND
           (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))

           OR ((all_organizations.organization_location='$o_l') AND (all_organizations.organization_type='$o_t') AND (all_organizations.organization_name!= '$o_n') AND
            (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))

           OR ((all_organizations.organization_location='$o_l') AND (all_organizations.organization_name!= '$o_n')  AND (REPLACE(LOWER(all_organizations.organization_name),'', '')=REPLACE(LOWER(organizations_img.organization_name),' ', ''))
         AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
           OR ((all_organizations.organization_fight='$o_f') AND (all_organizations.organization_name!= '$o_n')  AND (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', ''))
         AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
           OR ((all_organizations.organization_type='$o_t') AND (all_organizations.organization_name!= '$o_n') AND (REPLACE(LOWER(all_organizations.organization_name),' ', '')=REPLACE(LOWER(organizations_img.organization_name),' ', ''))
         AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' ))
            ORDER BY RAND() LIMIT 4";

            $resultRelatedBLiked = mysqli_query($conn, $sqlBLiked);

            $queryResultRelatedBLiked = mysqli_num_rows($resultRelatedBLiked);
            if ($queryResultRelatedBLiked >= 1) {

              echo '<div class="liked_suggestion">
                <br>
                <div class="choice-box">
                <div class="m_p_container" id="blike_container"><h1 class="normal-text centerize m_p_text">Related to
                </h1>
                <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowRealtedP2['name'] ).'"class="img-thumnail round-img"id="blike_img" /> </div>
                </div>
                  <ul>
                  ';
              while ($rowRealtedBLiked = mysqli_fetch_array($resultRelatedBLiked)) {
                $ox = $rowRealtedBLiked['organization_name'];
                $oz = $rowRealtedP2['organization_name'];

                echo '
                     <a href="check.org.php?o=' . ucwords($rowRealtedBLiked["organization_name"]) .'"><li>
                     <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowRealtedBLiked['name'] ).'"class="img-thumnail round-img" /> </div>
                     <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p>

                   </li></a>';
              }
              echo '
              </ul>
              </div>
              </div>';
            }else {
              // if no results
            }
          }
        }
       $limit = true;

     }
    }
  }
}
$sqlDonation = "SELECT * FROM transactions, all_organizations WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) ORDER BY amount DESC LIMIT 5";
$stmtDon = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmtDon,$sqlDonation)) {
  header("Location: mainpage.php?errorS=sqlerror");
  exit();
}else{
  mysqli_stmt_execute($stmtDon);
  mysqli_stmt_store_result($stmtDon);
  $resultCheckDon = mysqli_stmt_num_rows($stmtDon);
  if ($resultCheckDon <= 0) {
  }else{
    $result3 = mysqli_query($conn,$sqlDonation);
    $donated_org = array();

    // start of DONATED ORGANIZATIONS RECOMMANDATIONS FINDING

    // "all the world"
    $count_locDon = 0;

    // poverty
    $count_fightDon = 0;
    // hunger
    $count_fightDon2 = 0;
    // hunger&poverty
    $count_fightDon3 = 0;
    // disease
    $count_fightDon4 = 0;
    // abusation
    $count_fightDon5 = 0;

    // large
    $count_typeDon = 0;
    // medium
    $count_typeDon2 = 0;
    // small
    $count_typeDon3 = 0;

    $locDon = array();
    $fightDon = array();
    $typeDon = array();
    while($row3 = mysqli_fetch_array($result3)){

       $locDon[] = $row3["organization_location"];
       $fighDont[] = $row3["organization_fight"];
       $typeDon[] = $row3["organization_type"];

       $donated_org[] = $row3["organization_name"];
    }
    foreach ($locDon as $key => $value) {
      if ($value == "all the world") {
        $count_locDon++;
      }
    }

    foreach ($fightDon as $key => $value) {
      if ($value == "poverty") {
        $count_fightDon++;
      }else if ($value == "hunger") {
        $count_fightDon2++;
      }else if ($value == "hunger&poverty") {
        $count_fightDon3++;
      }else if ($value == "disease") {
        $count_fightDon4++;
      }else if ($value == "abusation") {
        $count_fightDon5++;
      }
    }

    foreach ($typeDon as $key => $value) {
      if ($value == "large") {
        $count_typeDon++;
      }else if ($value == "medium") {
        $count_typeDon2++;
      }else if ($value == "small") {
        $count_typeDon3++;
      }else {
        // Default $value = large
        $count_typeDon++;
      }
    }

    // GET FIGHT, LOCATION AND TYPE NY NUMBER


    // echo "
    // // all the world
    // $count_loc;
    //
    // // poverty
    // $count_fight;
    // // hunger
    // $count_fight2;
    // // hunger&poverty
    // $count_fight3;
    // // disease
    // $count_fight4;
    // // abusation
    // $count_fight5;
    //
    // // large
    // $count_type;
    // // medium
    // $count_type2;
    // // small
    // $count_type3//<br><br>
    // ";

    $top_loc_valueDon = max(0,$count_locDon);

    $top_fight_valueDon = max($count_fightDon, $count_fightDon2,$count_fightDon3,$count_fightDon4,$count_fightDon5);

    $top_type_valueDon = max($count_typeDon, $count_typeDon2, $count_typeDon3);

    // get highest fight choosen
    $location_nameDon = "all the world";
    if ($top_fight_valueDon == $count_fightDon && $top_fight_valueDon == $count_fightDon2) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "poverty";
      }else{
        $fight_nameDon = "hunger";
      }
    }else if($top_fight_valueDon == $count_fightDon && $top_fight_valueDon == $count_fightDon3){
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "poverty";
      }else{
        $fight_nameDon = "hunger&poverty";
      }
    }else if ($top_fight_valueDon == $count_fightDon && $top_fight_valueDon == $count_fightDon4) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "poverty";
      }else{
        $fight_nameDon = "disease";
      }
    }else if ($top_fight_valueDon == $count_fightDon && $top_fight_valueDon == $count_fightDon5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "poverty";
      }else{
        $fight_nameDon = "abusation";
      }
    }else if ($top_fight_valueDon == $count_fightDon2 && $top_fight_valueDon == $count_fightDon3) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "hunger";
      }else{
        $fight_nameDon = "hunger&poverty";
      }
    }else if ($top_fight_valueDon == $count_fight2 && $top_fight_valueDon == $count_fightDon4) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "hunger";
      }else{
        $fight_nameDon = "disease";
      }
    }else if ($top_fight_valueDon == $count_fightDon2 && $top_fight_valueDon == $count_fightDon5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "hunger";
      }else{
        $fight_nameDon = "abusation";
      }
    }else if ($top_fight_valueDon == $count_fightDon3 && $top_fight_valueDon == $count_fightDon4) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "hunger&poverty";
      }else{
        $fight_nameDon = "disease";
      }
    }else if ($top_fight_valueDon == $count_fightDon3 && $top_fight_valueDon == $count_fightDon5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "hunger&poverty";
      }else{
        $fight_nameDon = "abusation";
      }
    }else if ($top_fight_valueDon == $count_fightDon4 && $top_fight_valueDon == $count_fightDon5) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $fight_nameDon = "disease";
      }else{
        $fight_nameDon = "abusation";
      }
    }else {
      if ($top_fight_valueDon == $count_fightDon) {
        $fight_nameDon = "poverty";
      }else if ($top_fight_valueDon == $count_fightDon2) {
        $fight_nameDon = "hunger";
      }else if ($top_fight_valueDon == $count_fightDon3) {
        $fight_nameDon = "hunger&poverty";
      }else if ($top_fight_valueDon == $count_fightDon4) {
        $fight_nameDon = "disease";
      }else {
        $fight_nameDon = "abusation";
      }
    }

    // get highest type choosen between 2 by rand()

    if ($top_type_valueDon == $count_typeDon && $top_type_valueDon == $count_typeDon2) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $type_nameDon = "large";
      }else{
        $type_nameDon = "medium";
      }
    }else if($top_type_valueDon == $count_typeDon && $top_type_valueDon == $count_typeDon3){
      $rand = rand(1,2);
      if ($rand == 1) {
        $type_nameDon = "large";
      }else{
        $type_nameDon = "small";
      }
    }else if ($top_type_valueDon == $count_typeDon2 && $top_type_valueDon == $count_typeDon3) {
      $rand = rand(1,2);
      if ($rand == 1) {
        $type_nameDon = "medium";
      }else{
        $type_nameDon = "small";
      }
    }else {
      if ($top_type_valueDon == $count_typeDon) {
        $type_nameDon = "large";
      }else if ($top_type_valueDon == $count_typeDon2) {
        $type_nameDon = "medium";
      }else {
        $type_nameDon = "small";
      }
    }

    // end of highest type choosen by rand()

    // end of DONATED ORGANIZATIONS RECOMMANDATIONS FINDING
    $sqlFD = "SELECT * FROM transactions, all_organizations, organizations_img WHERE
    (organization_fight='$fight_nameDon' AND organization_location='$location_nameDon' AND organization_type='$type_nameDon' AND LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
    ) ORDER BY RAND();";
    $stmtFD = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmtFD,$sqlFD)) {
      header("Location: mainpage.php?errorS=sqlerror");
      exit();
    }else{
      mysqli_stmt_execute($stmtFD);
      mysqli_stmt_store_result($stmtFD);
      $resultCheckFD = mysqli_stmt_num_rows($stmtFD);
      if ($resultCheckFD <= 0) {
      }else{
        $limit = 0;
        $dupplicate = array();
        $resultFD = mysqli_query($conn,$sqlFD);
        echo '<hr><div class="ms-pop">
          <br>
          <div class="choice-box">
          <div class="m_p_container">
          <h1 class="normal-text centerize m_p_text">Related to your Donations</h1>
          </div>
            <ul>
            ';
        while ($rowFD = mysqli_fetch_array($resultFD)) {
          if ($limit >=5) {

          }else {
            if (in_array($rowFD["organization_name"] ,$dupplicate)) {
              // code...
            }else {
              echo '
                   <a href="check.org.php?o=' . ucwords($rowFD["organization_name"]) .'"><li>
                   <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowFD['name'] ).'"class="img-thumnail round-img" /> </div>
                   <p class="d_text-row">Donated: <span>$'.$rowFD["donation"].'</span></p>
                 </li></a>';
                 $limit++;
                 $dupplicate[] = $rowFD["organization_name"];
            }
          }
        }
        echo '
        </ul>
      </div>
    </div>';
      }
    }
  }
}
if (!$M2) {
  $sqlM = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
  $stmtM = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmtM,$sqlM)) {
    header("Location: mainpage.php?errorS=sqlerror");
    exit();
  }else{
    mysqli_stmt_execute($stmtM);
    mysqli_stmt_store_result($stmtM);
    $resultCheckM = mysqli_stmt_num_rows($stmtM);
    if ($resultCheckM <= 0) {
      header("Location: mainpage.php?error=noresult");
      exit();
    }else{
      $i = 1;
      $resultM = mysqli_query($conn,$sqlM);
      echo '<div class="ms-pop">
        <br>
        <div class="choice-box">
        <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>

          <ul>

          ';
    while($rowM = mysqli_fetch_array($resultM)){
     echo '
          <a href="check.org.php?o=' . ucwords($rowM["organization_name"]) .'"><li>
          <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowM['name'] ).'"class="img-thumnail round-img" /> </div>
          <p class="d_text-row">Donated: <span>$'.$rowM["donation"].'</span></p>


        </li></a>';
      }
      echo '
      </ul>
    </div>
  </div>';
  $M2 = true;
    }
  }
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
} -->
