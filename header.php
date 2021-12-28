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
                <li class="list"><a class="top-a right-push" href="cart.php">Cart</a></li>
								<li class="list"><a class="top-a signIn" href="login.php">Sign In</a></li>
								<li class="list"><a class="top-a signIn"id="donator-text" href="signup.php">Create account</a></li>
              </ul>
            </div>
						</nav>



						</div><div class="header">

						<div class="top">
							<div id="nav-icon3">
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>

						  <div class="nav">
						    <ul>
								<li class="list mo-list"><a class="top-a_un" href="cart.php">Cart</a></li>
								<li class="list mo-list"><a class="top-a_un signIn" href="login.php">Log In</a></li>
								<li class="list mo-list"><a class="top-a_un signIn s_text_hs" id="donator-text" href="signup.php">Sign Up</a></li>
						    </ul>
						  </div>
						</div>';
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
                <li class="list" id="list-top_arrw">
								<div class="top-arrw-position min-dis" id="top-arrw-div" onclick="class_dis()">
									<div class="arrow-down"></div>
								</div>

								<div class="top-arrw-position" id="top-arrw-div-re" onclick="class_disre()">
									<div class="arrow-down"></div>
								</div>
								<div class="tab_arr_disp" id="tab_arr_disp-id">
								<div class="sub-tab_arr_disp">
									<ul class="tab_arr_disp-tog">
										<a href="recommendations.php"><li class="tab_arr_disp-tog-al">Recommendations</li></a>
										<a href="user_donations.php"><li class="tab_arr_disp-tog-al">Donations</li></a>
										<a href="payment-info.php"><li class="tab_arr_disp-tog-al">Payments</li></a>
										<a href="includes/logout.inc.php"><li class="tab_arr_disp-tog-al">Sign Out</li></a>
									</ul>
									<div>
								</div></li>
              </ul>
            </div>
						</nav>
						</div>
						<div class="header">

						<div class="top">
							<div id="nav-icon3">
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>

						  <div class="nav">
						    <ul>
								<li class="list mo-list">
								<a class="top-a" href="cart.php">
									<span class="border_p_span">Cart</span>
								</a>
								</li>
								<li class="list mo-list"><a class="top-a" href="recommendations.php"><span class="border_p_span">Recommandations</span></a></li>
								<li class="list mo-list"><a class="top-a" href="user_donations.php"><span class="border_p_span">Donatations</span></a></li>
								<li class="list mo-list"><a class="top-a" href="account.php"><span class="border_p_span border_n_span">account</span></a></li>
						    </ul>
						  </div>
						</div>';
      }
			echo '<script src="js/main.js"></script>';
			?>
			<script type="text/javascript">
			$(document).ready(function(){
			$("#nav-icon3").click(function(){
			$(this).toggleClass("open");
			});
			});

			$(function(){
			var nav = $(".nav"),
			animateTime = 500,
			navLink = $(".header .top #nav-icon3");
			navLink.click(function(){
			if(nav.height() === 0){
			autoHeightAnimate(nav, animateTime);
			} else {
			nav.stop().animate({ height: "0" }, animateTime);
			}
			});
			})
			function autoHeightAnimate(element, time){
				var curHeight = element.height(), // Get Default Height
					autoHeight = element.css("height", "auto").height(); // Get Auto Height
					element.height(curHeight); // Reset to Default Height
					element.stop().animate({ height: autoHeight }, time); // Animate to Auto Height
			}

			</script>

<!-- LIKED SUB-LI REMOVED -->
			<!-- <li class="list mo-list"><a class="top-a" href="liked.php"><span class="border_p_span">Liked</span></a></li> -->

			<!-- LIKED ARROW DELETED -->
			<!-- <a href="liked.php"><li class="tab_arr_disp-tog-al">Liked</li></a> -->

			<!-- nav-icon3

			<div class="top">
				<div id="nav-icon3">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div> -->


			<!-- <li class="list mo-list"><a class="top-a signIn" href="myaccount.php">'. ucwords($_SESSION["userUid"]) . '</a></li> -->
