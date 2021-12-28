<?php
  require "includes/dbh.inc.php";
  $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
   ORDER BY RAND() DESC LIMIT 6"; // CHANGE LATER (likes and DONATIONS)
   $stmt = mysqli_stmt_init($conn);


 $sqlFull = "SELECT * FROM user_cart, transactions, all_organizations WHERE ((transactions.userId = '$session' AND user_cart.user_id = '$session' AND transactions.organizationId = all_organizations.organization_id AND user_cart.organization_id = all_organizations.organization_id))";
 $stmtFull = mysqli_stmt_init($conn);

 $sqlTransaction = "SELECT * FROM transactions, all_organizations WHERE (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) ORDER BY RAND() LIMIT 1";
 $stmtT = mysqli_stmt_init($conn);

 $sqlCart = "SELECT * FROM user_cart, all_organizations WHERE (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id) ORDER BY RAND() LIMIT 1";
 $stmtCart = mysqli_stmt_init($conn);

 $name_array = array();
 $loc_array = array();
 $fight_array = array();
 $type_array = array();


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


if (!mysqli_stmt_prepare($stmtFull,$sqlFull)) {
  header("Location: mainpage.php?errorS=sqlerror");
  exit();
}else{
  mysqli_stmt_execute($stmtFull);
  mysqli_stmt_store_result($stmtFull);
  $resultCheck = mysqli_stmt_num_rows($stmtFull);

// FULL $SQL

  if ($resultCheck <= 0) {
    if (!mysqli_stmt_prepare($stmtT,$sqlTransaction)) {
      header("Location: mainpage.php?errorS=sqlerror");
      exit();
    }else{
      mysqli_stmt_execute($stmtT);
      mysqli_stmt_store_result($stmtT);
      $resultCheckT = mysqli_stmt_num_rows($stmtT);

// SECOND $SQL(T)

      if ($resultCheckT <= 0) {

        if (!mysqli_stmt_prepare($stmtCart,$sqlCart)) {
          header("Location: mainpage.php?errorS=sqlerror");
          exit();
        }else{
          mysqli_stmt_execute($stmtCart);
          mysqli_stmt_store_result($stmtCart);
          $resultCheckC = mysqli_stmt_num_rows($stmtCart);

// THIRD $SQL(C)

          if ($resultCheckC <= 0) {
            if (!mysqli_stmt_prepare($stmt,$sql)) {
              header("Location: mainpage.php?errorS=sqlerror");
              exit();
            }else{
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              $resultCheckB = mysqli_stmt_num_rows($stmt);

// FOURTH $SQL(B)

              if ($resultCheckB > 0) {
                $i = 1;
                $result = mysqli_query($conn,$sql);
                echo '<div class="left_side_page" id="bottom-page-related">
                  <div class="left_side_related">
                  <br>
                  <Br>
                  <hr class="title_line"><br>
                  <div id="response"></div>';

                  echo "<div class='related-div'>";
                                        echo '<br>';
                  echo '<div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommended for you</h1></div>';
                  while($row = mysqli_fetch_array($result)){
                    if ($i == 1) {

                             echo '<div class="img-container">
                               <div class="org-logo">
                                 <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a>
                                 </div>
                               <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
                             </div>';
                           $i++;
                    }else{
                      echo '<div class="img-container">
                        <div class="org-logo">
                        <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a> </div>
                        <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
                      </div>';
                      }
                  }
                  echo "</div>";

// FOURTH $SQL(B)

             }else {
             }
             echo "</div>";
           }

            // THIRD $SQL(C)

          }else {
            $result = mysqli_query($conn,$sqlCart);
             while($row = mysqli_fetch_array($result)){

               $name_array[] = $row["organization_name"];
               $loc_array[] = $row["organization_location"];
               $fight_array[] = $row["organization_fight"];
               $type_array[] = $row["organization_type"];
             }
             foreach ($loc_array as $key => $value) {
               if ($value == "all the world") {
                 $count_loc++;
               }
             }

             foreach ($fight_array as $key => $value) {
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

             foreach ($type_array as $key => $value) {
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
              AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))

             OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
             OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
             (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
             OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
             OR ((all_organizations.organization_location='$org_loc_sql') AND
              (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
             OR ((all_organizations.organization_fight='$fight_name') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
             OR ((all_organizations.organization_type='$type_name') AND
              (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' )) ORDER BY RAND() LIMIT 6";
             $resultRelated = mysqli_query($conn, $sqlRelated);

             $queryResultRelated = mysqli_num_rows($resultRelated);

             echo '<div class="left_side_page" id="bottom-page-related">
               <div class="left_side_related">
               <br>
               <Br>
               <hr class="title_line"><br>
               <div id="response"></div>';

             if ($queryResultRelated >= 1) {
               $i=1;

                 echo "<div class='related-div'>";
                                       echo '<br>';
                 echo '<div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommended for you</h1></div>';
                 while($row = mysqli_fetch_array($resultRelated)){
                   if ($i == 1) {

                            echo '<div class="img-container">
                              <div class="org-logo">
                                <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a>
                                </div>
                              <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
                            </div>';
                          $i++;
                   }else{
                     echo '<div class="img-container">
                       <div class="org-logo">
                       <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a> </div>
                       <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
                     </div>';
                     }
                 }
                 echo "</div>";
             }
             echo "</div>";

          }
        }

        // SECOND $SQL(T)

      }else {
        $result = mysqli_query($conn,$sqlTransaction);
         while($row = mysqli_fetch_array($result)){

           $name_array[] = $row["organization_name"];
           $loc_array[] = $row["organization_location"];
           $fight_array[] = $row["organization_fight"];
           $type_array[] = $row["organization_type"];
         }
         foreach ($loc_array as $key => $value) {
           if ($value == "all the world") {
             $count_loc++;
           }
         }

         foreach ($fight_array as $key => $value) {
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

         foreach ($type_array as $key => $value) {
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
          AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))

         OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
          (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
         OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
         (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
         OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
          (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
         OR ((all_organizations.organization_location='$org_loc_sql') AND
          (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
         OR ((all_organizations.organization_fight='$fight_name') AND
          (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
         OR ((all_organizations.organization_type='$type_name') AND
          (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' )) ORDER BY RAND() LIMIT 6";
         $resultRelated = mysqli_query($conn, $sqlRelated);

         $queryResultRelated = mysqli_num_rows($resultRelated);

         echo '<div class="left_side_page" id="bottom-page-related">
           <div class="left_side_related">
           <br>
           <Br>
           <hr class="title_line"><br>
           <div id="response"></div>';

         if ($queryResultRelated >= 1) {
           $i=1;

             echo "<div class='related-div'>";
                                   echo '<br>';
             echo '<div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommended for you</h1></div>';
             while($row = mysqli_fetch_array($resultRelated)){

                        echo '<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><div class="img-container">
                          <div class="org-logo">
                            <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a>
                            </div>
                          <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
                        </div>';
             }
             echo "</div>";
         }
         echo "</div>";

      }
    }

// FULL $SQL

  }else{
    $result = mysqli_query($conn,$sqlFull);
     while($row = mysqli_fetch_array($result)){

       $name_array[] = $row["organization_name"];
       $loc_array[] = $row["organization_location"];
       $fight_array[] = $row["organization_fight"];
       $type_array[] = $row["organization_type"];
     }
     foreach ($loc_array as $key => $value) {
       if ($value == "all the world") {
         $count_loc++;
       }
     }

     foreach ($fight_array as $key => $value) {
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

     foreach ($type_array as $key => $value) {
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
      AND (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))

     OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_fight='$fight_name') AND
      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
     OR ((all_organizations.organization_fight='$fight_name') AND (all_organizations.organization_type='$type_name') AND
     (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
     OR ((all_organizations.organization_location='$org_loc_sql') AND (all_organizations.organization_type='$type_name') AND
      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
     OR ((all_organizations.organization_location='$org_loc_sql') AND
      (REPLACE(all_organizations.organization_name,'', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
     OR ((all_organizations.organization_fight='$fight_name') AND
      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' ))
     OR ((all_organizations.organization_type='$type_name') AND
      (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $name_array ) . "' )) ORDER BY RAND() LIMIT 6";
     $resultRelated = mysqli_query($conn, $sqlRelated);

     $queryResultRelated = mysqli_num_rows($resultRelated);

     echo '<div class="left_side_page" id="bottom-page-related">
       <div class="left_side_related">
       <br>
       <Br>
       <hr class="title_line"><br>
       <div id="response"></div>';

     if ($queryResultRelated >= 1) {
       $i=1;

         echo "<div class='related-div'>";
                               echo '<br>';
         echo '<div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommended for you</h1></div>';
         while($row = mysqli_fetch_array($resultRelated)){
           if ($i == 1) {

                    echo '<div class="img-container">
                      <div class="org-logo">
                        <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a></a>
                        </div>
                      <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
                    </div>';
                  $i++;
           }else{
             echo '<div class="img-container">
               <div class="org-logo">
               <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail img_size" /></a></a> </div>
               <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'&l=n"><button type="submit" name="submit-donate" class="signIn check-case top-bt learn_more-bt">Learn More</button></a>
             </div>';
             }
         }
         echo "</div>";
     }
     echo "</div>";

   }
 }
 ?>
