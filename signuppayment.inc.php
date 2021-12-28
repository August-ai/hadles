<?php
if (!isset($_SESSION['userId'])) {

		require 'dbh.inc.php';
		$mailuid = mysqli_real_escape_string($conn, $_POST['uidmail']);

		$firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
		$lastname = mysqli_real_escape_string($conn, $_POST['last_name']);
		$fullname = $firstname.$lastname;
		$email = mysqli_real_escape_string($conn, $_POST['mail']);
		$password = mysqli_real_escape_string($conn, $_POST['pwd']);
		$passwordRepeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);

		if (empty($firstname) || empty($lastname) || empty($email)|| empty($password)|| empty($passwordRepeat)) {
			header("Location: ../signuppayment.php?errorS=emptyfields&first_name=".$firstname."&last_name=".$lastname."&mail=".$email."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $firstname))&& (!preg_match("/^[a-zA-Z0-9]*$/", $lastname)) ) {
			header("Location: ../signuppayment.php?errorS=invalidmail&uid&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $firstname))) {
			header("Location: ../signuppayment.php?errorS=invalidmail&first_name&last_name=".$lastname."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $lastname))) {
			header("Location: ../signuppayment.php?errorS=invalidmail&last_name&first_name=".$firstname."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signuppayment.php?errorS=invalidmail&first_name=".$firstname."&last_name=".$lastname."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9- ]*$/", $firstname)) {
			header("Location: ../signuppayment.php?errorS=invalidfirst_name&last_name=".$lastname."&mail=".$email."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}else if (!preg_match("/^[a-zA-Z0-9- ]*$/", $lastname)) {
			header("Location: ../signuppayment.php?errorS=invalidfirst_name&last_name=".$lastname."&mail=".$email."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}
		else if ($password !== $passwordRepeat) {
			header("Location: ../signuppayment.php?errorS=passwordcheck&first_name=".$firstname."&last_name=".$lastname."&mail=".$email."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}else if (strlen($password) < 6) {
			header("Location: ../signuppayment.php?errorS=passwordchar&first_name=".$firstname."&last_name=".$lastname."&mail=".$email."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
			exit();
		}
		else{
			$sql = "SELECT first_Users, last_Users FROM users WHERE first_Users=? AND last_Users=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("Location: ../signuppayment.php?errorS=sqlerror&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"ss",$firstname,$lastname);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
					$sql = "SELECT email_Users FROM users WHERE email_Users=?";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("Location: ../signuppayment.php?errorS=sqlerror&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt,"s",$email);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						$resultCheck = mysqli_stmt_num_rows($stmt);
						if ($resultCheck > 0) {
							header("Location: ../signuppayment.php?errorS=emailtaken&first_name=".$firstname."&last_name=".$lastname."&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
						exit();
						}else{
							$sql="INSERT INTO users(first_Users,last_Users,full_name,email_Users,pwd_Users) VALUES (?,?,?,?,?)";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: ../signuppayment.php?errorS=sqlerrors&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
								exit();
							}
							else{
								$hashedPwd = password_hash($password,PASSWORD_DEFAULT);

								mysqli_stmt_bind_param($stmt,"sssss",$firstname,$lastname,$fullname,$email,$hashedPwd);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);

								$sql = "SELECT * FROM users WHERE full_name=? OR email_Users=?;";
								if (!mysqli_stmt_prepare($stmt,$sql)) {
									header("Location: ../login.php?error=sqlerror&signincheckout&o=".$_GET['o']."&donationamount=".$_GET["donationamount"]."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
									exit();
								}else{
									mysqli_stmt_bind_param($stmt, "ss", $fullname,$email);
									mysqli_stmt_execute($stmt);
									$result = mysqli_stmt_get_result($stmt);
									$row = mysqli_fetch_assoc($result);
									session_start();
									$_SESSION['userId'] = $row['id_Users'];
									$_SESSION['userUid'] = $row['first_Users'];
									header("Location: ../paymentS.php?action=ckeckout&session=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
									exit();
								}
							}
						}
					}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);

}else{
	header("Location: ../mainpage.php");
	exit();
}
