<?php

require "includes/dbh.inc.php";
$sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY RAND() LIMIT 3";
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

       echo '<div class="bs-example">
           <div id="learn_more_carousel" class="carousel slide" data-interval="11000" data-ride="carousel">
               <div class="carousel-inner">
                   ';
                   while ($row = mysqli_fetch_array($result)) {
                     $resume_count = substr($row["organization_resume"],0,430);
                     $resume_count_short = substr($resume_count,0,130);

                     if ($i==1) {

                       echo '<div class="item active ">

                           <div class="text-fraction_resume-carousel">
                            <div class="remp_resume_frac1">'.$resume_count.'...<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'">Learn more</a></div>
                            <div class="remp_resume_frac2">'.$resume_count_short.'...<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'">Learn more</a></div>
                           </div><a href="check.org.php?o='.$row["organization_name"].'"><div class="carousel_img_container"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class=""/> </div></a>
                       </div>';
                       $i++;
                     }
                     else if ($i==2) {
                       echo '<div class="item ">
                           <a href="check.org.php?o='.$row["organization_name"].'"><div class="carousel_img_container"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class=""/> </div></a>
                           <div class="text-fraction_resume-carousel">
                           <div class="remp_resume_frac1">'.$resume_count.'...<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'">Learn more</a></div>
                           <div class="remp_resume_frac2">'.$resume_count_short.'...<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'">Learn more</a></div>
                           </div>
                       </div>';
                       $i++;
                     }
                     else if ($i==3) {
                       echo '<div class="item ">
                           <a href="check.org.php?o='.$row["organization_name"].'"><div class="carousel_img_container"> <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class=""/> </div></a>
                           <div class="text-fraction_resume-carousel">
                           <div class="remp_resume_frac1">'.$resume_count.'...<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'">Learn more</a></div>
                           <div class="remp_resume_frac2">'.$resume_count_short.'...<a href="check.org.php?o=' . ucwords($row["organization_name"]) .'">Learn more</a></div>
                           </div>
                       </div>';
                       $i++;
                     }
                   }
                   echo '
               </div>
               <a class="carousel-control left reposition_arrw" href="#learn_more_carousel" data-slide="prev">
                   <span class="glyphicon glyphicon-chevron-left"></span>
               </a>
               <a class="carousel-control right reposition_arrw" href="#learn_more_carousel" data-slide="next">
                   <span class="glyphicon glyphicon-chevron-right"></span>
               </a>
           </div>
       </div>';
  }
}
 ?>

 <!-- <ol class="carousel-indicators">
     <li data-target="#learn_more_carousel" data-slide-to="0" class="active"></li>
     <li data-target="#learn_more_carousel" data-slide-to="1"></li>
     <li data-target="#learn_more_carousel" data-slide-to="2"></li>
 </ol> -->
