<?php
	session_start();
	if (!isset($_SESSION['unsigned_id']) && !isset($_SESSION['userId'])) {
		$unique = hexdec(uniqid());
		$unique = str_replace('E+15','E+9',$unique);

		$_SESSION['unsigned_id'] = (INT)$unique;
		$session = $_SESSION['unsigned_id'];
	}elseif (isset($_SESSION['unsigned_id']) && !isset($_SESSION['userId'])) {
		$session = $_SESSION['unsigned_id'];
	}else {
		$session = $_SESSION['userId'];
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/demo.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <header class="min-header">
			<?php
      require "includes/dbh.inc.php";
      $organization_result = strtolower(str_replace(' ', '', $_GET['o']));
      $organization_search = mysqli_real_escape_string($conn, $organization_result);
      $organization = mysqli_real_escape_string($conn, $_GET['o']);
      $sql = "SELECT * FROM all_organizations,organizations_img WHERE (REPLACE(all_organizations.organization_name,' ', '')= '$organization_search') AND
      (REPLACE(all_organizations.organization_name,' ', ''))=(REPLACE(organizations_img.organization_name,' ', '')) ";
      $result = mysqli_query($conn, $sql);
      $queryResult = mysqli_num_rows($result);

      if ($queryResult == 1) {
        while($row = mysqli_fetch_array($result)){
          echo '<h1><a href="mainpage.php" class="min-logo">Hadles  <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'"class="img-thumnail round-img mini_img " id="name-img" /></a></h1>
					';

        }
      }else {
        echo "There was a problem we will try to fix it as soon as possible";
      }
       ?>

      <?php
      $purl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       ?>

    </header>
