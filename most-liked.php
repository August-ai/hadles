<?php
  require "header.php";
  require "includes/dbh.inc.php";
 ?>

  <?php

    $sqlinit = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) =
    LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY likes DESC";

    $stmtinit = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmtinit,$sqlinit)) {
      header("Location: mainpage.php?errorS=sqlerror");
      exit();
    }else {
      mysqli_stmt_execute($stmtinit);
      mysqli_stmt_store_result($stmtinit);
      $resultRelated = mysqli_query($conn, $sqlinit);
      $resultCheckintit = mysqli_stmt_num_rows($stmtinit);
      if ($resultCheckintit > 0) {
        $arr_num = 0;
        $i = 1;
        $name_array = array();
        $order_array = array();
        $count = 0;

        // $rowinit = array_unique($rowinit);

        echo '<div class="ms-pop">
          <br>
          <div class="choice-box">
            <ul>
            ';

        while ($rowinit = mysqli_fetch_array($resultRelated)) {
          if ($rowinit['likes'] > 0) {
            $x = 0;
            $duplicate = false;

              foreach ($name_array as $key => $value) {
                if (str_replace(' ', '', strtolower($name_array[$x])) == str_replace(' ', '', strtolower(strtolower($rowinit['organization_name'])))) {
                  $duplicate = true ;
                }
                $x++;
              }
              if ($duplicate) {

              }else {
                       if ($i == 1) {
                         if ($rowinit['likes'] > 1) {
                           echo '
                                  <li>
                                  <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Liked</h1></div>
                                  <div>
                                  <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                                    <br>
                                    <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                                    <br>
                                    <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                                    <h2 class="f-info">'.$rowinit['likes'].' likes</h2>
                                    <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                                  <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                                  <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                                  </div>
                                </li>';
                                $i++;
                         }else {
                           echo '
                                  <li>
                                  <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Liked</h1></div>
                                  <div>
                                  <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                                    <br>
                                    <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                                    <br>
                                    <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                                    <h2 class="f-info">'.$rowinit['likes'].' like</h2>
                                    <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                                  <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                                  <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                                  </div>
                                </li>';
                                $i++;
                         }
                       }else if ($i == 2) {
                         if ($rowinit['likes'] > 1) {
                           echo '
                           <li>
                           <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                             <br>
                             <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                             <br>
                             <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                             <h2 class="f-info">'.$rowinit['likes'].' likes</h2>
                             <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                             <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                           </li>';
                         }else {
                           echo '
                           <li>
                           <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                             <br>
                             <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                             <br>
                             <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                             <h2 class="f-info">'.$rowinit['likes'].' like</h2>
                             <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                             <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                           </li>';
                         }
                         $i++;
                         }else if ($i == 3) {
                           if ($rowinit['likes'] > 1) {
                             echo '
                             <li>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                               <br>
                               <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                               <br>
                               <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                               <h2 class="f-info">'.$rowinit['likes'].' likes</h2>
                               <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                               <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                               <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                             </li>';
                           }else {
                             echo '
                             <li>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                               <br>
                               <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                               <br>
                               <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                               <h2 class="f-info">'.$rowinit['likes'].' like</h2>
                               <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                               <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                               <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                             </li>';
                           }
                           $i++;
                       }else if ($i == 4){
                         if ($rowinit['likes'] > 1) {
                           echo '
                           <li>
                           <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                             <br>
                             <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                             <br>
                             <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                             <h2 class="f-info">'.$rowinit['likes'].' likes</h2>
                             <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                             <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                           </li>';
                         }else {
                           echo '
                           <li>
                           <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                             <br>
                             <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                             <br>
                             <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                             <h2 class="f-info">'.$rowinit['likes'].' like</h2>
                             <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                             <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                           </li>';
                         }
                       }else {
                         if ($rowinit['likes'] > 1) {
                           echo '
                           <li>
                           <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                             <br>
                             <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                             <br>
                             <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                             <h2 class="f-info">'.$rowinit['likes'].' likes</h2>
                             <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                             <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                           </li>';
                         }else {
                           echo '
                           <li>
                           <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><div class="title">' . ucwords($rowinit["organization_name"]) .'</div></a>
                             <br>
                             <h2 class="f-info">Helping in: ' . ucwords($rowinit["organization_location"]) .'</h2>
                             <br>
                             <h2 class="f-info">Fighting For: ' . ucwords($rowinit["organization_fight"]) .'</h2>
                             <h2 class="f-info">'.$rowinit['likes'].' like</h2>
                             <a href="donate.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                             <a href="check.org.php?o=' . ucwords($rowinit["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                             <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($rowinit['name'] ).'"class="img-thumnail round-img" /> </div>
                           </li>';
                         }
                       }
                     }
                $name_array[$arr_num] = $rowinit['organization_name'];
                $arr_num++;
          }
        }
        echo '
        </ul>
      </div>
    </div>';
    // print_r($order_array);echo "<br><br>";
    //
    // print_r($name_array);
      }

    }
      mysqli_stmt_close($stmtinit);
      mysqli_close($conn);


   ?>

<?php require "footer.php"; ?>
