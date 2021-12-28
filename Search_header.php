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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  </head>
  <body>
    <div class="main-container1">
      <?php
			require "includes/dbh.inc.php";
			$purl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (empty($_GET)) {
				$search_input = mysqli_real_escape_string($conn, $_GET['s']);
			  $search = str_replace(' ', '', $search_input);
			  $search_space = trim(mysqli_real_escape_string($conn, $search_input));
				$simple_search = $_GET['s'];
			}else {
				$search_input = mysqli_real_escape_string($conn, $_GET['s']);
			  $search_result = str_replace(' ', '', $search_input);
			  $search = mysqli_real_escape_string($conn, $search_result);
			  $search_space = trim(mysqli_real_escape_string($conn, $search_input));
				$simple_search = $_GET['s'];
			}
			if (!isset($_SESSION['userId'])) {
				echo '
            <nav class="top-nav">
              <h2 id="long-top-text"><a id="logo-name" href="mainpage.php">Hadles<h6 class="name_cont">a simple way to donate</h3></a></h2>
							<form class="existing-org" action="result.php" method="post" autocomplete="off">
							<div class="search-org">
					      <input type="text" name="search" id="search-assoc ui-autocomplete" placeholder="Search an Organization" value='.$simple_search.'>
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
					      <input type="text" name="search" id="search-assoc" placeholder="Search an Organization" value='.$simple_search.'>
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
											<a href="user_donations.php"><li class="tab_arr_disp-tog-al">Donations</li></a>
											<a href="informations.php"><li class="tab_arr_disp-tog-al">Payments</li></a>
											<a href="informations.php"><li class="tab_arr_disp-tog-al">Informations</li></a>
											<a href="includes/logout.inc.php"><li class="tab_arr_disp-tog-al">Sign Out</li></a>
										</ul>
										<div>
									</div></li>
	              </ul>
	            </div>
							</nav>
							</div>
							<div class="header">



							  <div class="nav">
							    <ul>
									<li class="list mo-list">
									<a class="top-a" href="cart.php">
										<span class="border_p_span">Cart</span>
									</a>
									</li>
									<li class="list mo-list"><a class="top-a" href="user_donations.php"><span class="border_p_span">Donatations</span></a></li>
									<li class="list mo-list"><a class="top-a" href="informations.php"><span class="border_p_span border_n_span">account</span></a></li>
							    </ul>
							  </div>
							</div>';
      }
      ?>
		<?php
		echo '<script src="js/main.js"></script>';

		  ?>
		<script>

		$(document).ready(function(){
	$('#nav-icon3').click(function(){
		$(this).toggleClass('open');
	});
});

		$(function(){
var nav = $('.nav'),
		animateTime = 500,
		navLink = $('.header .top #nav-icon3');
navLink.click(function(){
	if(nav.height() === 0){
		autoHeightAnimate(nav, animateTime);
	} else {
		nav.stop().animate({ height: '0' }, animateTime);
	}
});
})
function autoHeightAnimate(element, time){
  	var curHeight = element.height(), // Get Default Height
        autoHeight = element.css('height', 'auto').height(); // Get Auto Height
    	  element.height(curHeight); // Reset to Default Height
    	  element.stop().animate({ height: autoHeight }, time); // Animate to Auto Height
}
		</script>
