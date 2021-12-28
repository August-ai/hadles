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
    <title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/demo.css" />
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet"> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  </head>
  <body>
		<div class="all-container_select">
    <div class="main-container1">
      <?php

			$purl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (!isset($_SESSION['userId'])) {
				echo '
            <nav class="top-nav">
              <h2 id="long-top-text"><a id="logo-name" href="mainpage.php">Hadles<h6 class="name_cont">a simple way to donate</h3></a></h2>
							<form class="existing-org" action="result.php" method="post" autocomplete="off">
							<div class="search-org">
					      <input type="text" name="search" id="search-assoc ui-autocomplete" placeholder="Search an Organization">
					      <button type="submit" name="search_assoc" id="search-bt"><i class="fa fa-search"></i></button>
								</div>
							</form>
            <div class="right-nav m_top">
              <ul class="top-placing">
                <li class="list"><a class="top-a donate-case-list donate-stay" id="top_stay" href="donation.php">Donate</a>

								</li>

								<li class="list"><a class="top-a signIn" href="login.php">Sign In</a></li>
								<li class="list"><a class="top-a signIn"id="donator-text" href="signup.php">Create account</a></li>
              </ul>
            </div>
						</nav>';
				}else{
					echo '
            <nav class="top-nav">
              <h2 id="long-top-text"><a id="logo-name" href="mainpage.php">Hadles<h6 class="name_cont">a simple way to donate</h3></a></h2>
							<form class="existing-org" action="result.php" method="post" autocomplete="off">
							<div class="search-org">
					      <input type="text" name="search" id="search-assoc" placeholder="Search an Organization">
					      <button type="submit" name="search_assoc" id="search-bt"><i class="fa fa-search"></i></button>
								</div>
					    </form>
            <div class="right-nav">
						<ul class="top-placing" id="top-placaing-rightS">

                <li class="list"><a class="top-a donate-case-list donate-stay" id="top_stayS" href="donation.php">Donate</a>
								</li>
                <li class="list" id="cart-stay"><a class="top-a right-push" href="cart.php">Cart</a></li>
              </ul>
            </div>
						</nav>
						</div>';
      }
