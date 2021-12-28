<?php require "header.php";
  require "includes/dbh.inc.php";
  if (!isset($_SESSION["userId"])) {
    $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
     ORDER BY likes DESC LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
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
          <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Popular</h1></div>

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
    $sqlL = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY RAND() LIMIT 5"; // CHANGE LATER ORDER(DONATED)
    $stmtL = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmtL,$sqlL)) {
    }else{
      mysqli_stmt_execute($stmtL);
      mysqli_stmt_store_result($stmtL);
      $resultCheckL = mysqli_stmt_num_rows($stmtL);
      if ($resultCheckL <= 0) {
      }else{
        $i = 1;
        $resultL = mysqli_query($conn,$sqlL);
        echo '<hr><div class="ms-pop">
          <br>
          <div class="choice-box">
          <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Donated</h1></div>

            <ul>

            ';
      while($row = mysqli_fetch_array($resultL)){
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


    $sqlR = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY all_organizations.time DESC, RAND() LIMIT 5";
    $stmtR = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmtR,$sqlR)) {
    }else{
      mysqli_stmt_execute($stmtR);
      mysqli_stmt_store_result($stmtR);
      $resultCheckR = mysqli_stmt_num_rows($stmtR);
      if ($resultCheckR <= 0) {
      }else{
        $i = 1;
        $resultR = mysqli_query($conn,$sqlR);
        echo '<hr><div class="ms-pop">
          <br>
          <div class="choice-box">
          <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Recent</h1></div>

            <ul>

            ';
      while($row = mysqli_fetch_array($resultR)){
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


}else if (isset($_SESSION["userId"])) {
    $m_show = false;
    $sql = "SELECT * FROM user_cart, transactions, all_organizations WHERE ((transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id AND user_cart.organization_id = all_organizations.organization_id)
    OR (transactions.userId = '$session' AND transactions.organizationId = all_organizations.organization_id) OR (user_cart.user_id = '$session' AND user_cart.organization_id = all_organizations.organization_id)) ORDER BY RAND() LIMIT 1";
    $stmt = mysqli_stmt_init($conn);

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

           $locDon[] = $row2["organization_location"];
           $fighDon[] = $row2["organization_fight"];
           $typeDon[] = $row2["organization_type"];

           $All_Wtch_organizations[] = $row2["organization_name"];
        }

        $sqlM = "SELECT * FROM all_organizations, organizations_img WHERE REPLACE(LOWER(all_organizations.organization_name),' ', '') = REPLACE(LOWER(organizations_img.organization_name),' ', '')
        ORDER BY RAND() LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
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
          while($row = mysqli_fetch_array($resultM)){
           echo '
                <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><li>
                <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                <p class="d_text-row">Donated: <span>$'.$row["donation"].'</span></p></li></a>';
            }
            echo '
            </ul>
          </div>
        </div>';
          }
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
            echo "type not matching";
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

        // get highest type choosen

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

        // end of highest type choosen


       while($row = mysqli_fetch_array($result)){
         $org_name_sql = $row["organization_name"];

         $org_loc_sql = $row["organization_location"];

         $sqlL = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY RAND() LIMIT 5"; //CHANGE LATER ORDER
         $stmtL = mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmtL,$sqlL)) {
         }else{
           mysqli_stmt_execute($stmtL);
           mysqli_stmt_store_result($stmtL);
           $resultCheckL = mysqli_stmt_num_rows($stmtL);
           if ($resultCheckL <= 0) {
           }else{
             $i = 1;
             $resultL = mysqli_query($conn,$sqlL);
             echo '<div class="ms-pop">
               <br>
               <div class="choice-box">
               <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Donated</h1></div>

                 <ul>

                 ';
           while($row = mysqli_fetch_array($resultL)){
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


         $sqlR = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY all_organizations.time DESC, RAND() LIMIT 5";
         $stmtR = mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmtR,$sqlR)) {
         }else{
           mysqli_stmt_execute($stmtR);
           mysqli_stmt_store_result($stmtR);
           $resultCheckR = mysqli_stmt_num_rows($stmtR);
           if ($resultCheckR <= 0) {
           }else{
             $i = 1;
             $resultR = mysqli_query($conn,$sqlR);
             echo '<div class="ms-pop">
               <br>
               <div class="choice-box">
               <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Recent</h1></div>

                 <ul>

                 ';
           while($row = mysqli_fetch_array($resultR)){
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
            (REPLACE(all_organizations.organization_name,' ', '')=REPLACE(organizations_img.organization_name,' ', '')) AND all_organizations.organization_name NOT IN ( '" . implode( "', '" , $liked_organizations ) . "' )) ORDER BY RAND() LIMIT 5";
           $resultRelated = mysqli_query($conn, $sqlRelated);

           $queryResultRelated = mysqli_num_rows($resultRelated);
           if ($queryResultRelated >= 1) {
             $i=1;

             echo '<div class="ms-pop">
               <br>
               <div class="choice-box">
               <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Recommandations</h1></div>

                 <ul>

                 ';
           while($row = mysqli_fetch_array($resultRelated)){
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
           }else {

           }
           // RECOMMANDATIONS continue...

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
                ORDER BY RAND() LIMIT 5";

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
    if (!$m_show) {
      $sqlM = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY likes DESC LIMIT 5"; // CHANGE LATER (likes and DONATIONS)
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
        while($row = mysqli_fetch_array($resultM)){
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
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
   ?>

  <script type="text/javascript">
  var img = document.getElementById('blike_img');
  //or however you get a handle to the IMG
  var width = img.clientWidth;
  var height = img.clientHeight;
  var separation = 22;
  var spaceimg = 10;
  var finalimg_top = height - spaceimg;
  var finalheightb = -height - separation;
  document.getElementById("blike_container").style.marginBottom = finalheightb + "px";
  document.getElementById("blike_img").style.top = -finalimg_top + "px";

  </script>
