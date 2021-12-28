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
      <div class="short_headerTpe">
        <div class="right-logo_h">
          <a href="mainpage.php" id="logo-name">Hadles</a>
        </div>
      </div>
