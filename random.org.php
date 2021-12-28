<?php

  if (isset($_POST['give-rand'])) {
    require "includes/dbh.inc.php";
    $sql = "SELECT * FROM all_organizations, organizations_img WHERE LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) ORDER BY RAND() LIMIT 1";
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
        $result = mysqli_query($conn,$sql);
         while($row = mysqli_fetch_array($result)){
           header("Location: check.org.php?o=".$row['organization_name']."");
           exit();
    }
   }
 }
mysqli_stmt_close($stmt);
mysqli_close($conn);
require "footer.php";

  }else{
    header("Location: mainpage.php");
    exit();
  }

 ?>
