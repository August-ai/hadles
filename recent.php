<?php
  require "header.php";
  require "includes/dbh.inc.php";
 ?>

  <?php

    $sql = "SELECT * FROM all_organizations, organizations_img WHERE REPLACE(LOWER(all_organizations.organization_name),' ','') = LOWER(REPLACE(organizations_img.organization_name,' ', ''))
     ORDER BY all_organizations.time DESC";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: mainpage.php?errorS=sqlerror");
      exit();
    }else {
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $results = mysqli_query($conn, $sql);
      $resultCheckintit = mysqli_stmt_num_rows($stmt);
      echo "number of result check: $resultCheckintit<br>";
      if ($resultCheckintit > 0) {
        $i = 1;

        echo '<div class="ms-pop">
          <br>
          <div class="choice-box">
            <ul>
            ';

        while ($row = mysqli_fetch_array($results)) {
          if ($i == 1) {
            echo '
                   <li>
                   <div class="m_p_container"><h1 class="normal-text centerize m_p_text">Most Recent</h1></div>
                   <div>
                   <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><div class="title">' . ucwords($row["organization_name"]) .'</div></a>
                     <br>
                     <h2 class="f-info">Helping in: ' . ucwords($row["organization_location"]) .'</h2>
                     <br>
                     <h2 class="f-info">Fighting For: ' . ucwords($row["organization_fight"]) .'</h2>
                     <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                   <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                   <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                   </div>
                 </li>';
                 $i++;
          }else {
            echo '
                   <li>
                   <div>
                   <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><div class="title">' . ucwords($row["organization_name"]) .'</div></a>
                     <br>
                     <h2 class="f-info">Helping in: ' . ucwords($row["organization_location"]) .'</h2>
                     <br>
                     <h2 class="f-info">Fighting For: ' . ucwords($row["organization_fight"]) .'</h2>
                     <a href="donate.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn donate-case top-bt">Donate</button></a>
                   <a href="check.org.php?o=' . ucwords($row["organization_name"]) .'"><button type="submit" name="submit-donate" class="signIn check-case top-bt">Check</button></a>
                   <div class="org-logo"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img" /> </div>
                   </div>
                 </li>';
          }
        }
      }
    }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);


   ?>

<?php require "footer.php"; ?>
