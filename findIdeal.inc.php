<?php
if (isset($_POST['find-org'])) {
  require "includes/dbh.inc.php";
  $association_location = $_POST['location'];
  $association_type = $_POST['type'];
  $association_fight = $_POST['fight'];

  if ($association_location == "" || $association_type == "" || $association_fight == "") {
    header("Location: findIdeal.php?error=selectnone");
    exit();
  }else{
    $sql = "SELECT * FROM all_organizations WHERE organization_location=? AND organization_fight=? AND organization_type=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location: findIdeal.php?errorS=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"sss",$association_location, $association_fight,$association_type);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck <= 0) {
        header("Location: findIdeal.php?error=noresult");
        exit();
			}else{
        $result = mysqli_query($conn,"SELECT all_organizations.organization_name,all_organizations.organization_location,all_organizations.organization_fight,
          all_organizations.organization_type,all_organizations.organization_resume,organizations_img.name
           FROM all_organizations,organizations_img WHERE all_organizations.organization_location='$association_location' AND all_organizations.organization_type='$association_type'
           AND all_organizations.organization_fight = '$association_fight' AND
           LOWER(REPLACE(all_organizations.organization_name,' ', '')) = LOWER(REPLACE(organizations_img.organization_name,' ', '')) LIMIT 1");
           while($row = mysqli_fetch_array($result)){
             header("Location: check.org.php?o=".$row['organization_name']."");
             exit();
      }
    }
  }
}
  mysqli_stmt_close($stmt);
	mysqli_close($conn);
}else {
  header("Location: findIdeal.php");
  exit();
}
?>
