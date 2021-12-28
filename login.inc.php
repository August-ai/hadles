<?php
if (!isset($_SESSION['userId'])) {
		require 'dbh.inc.php';

		$mailuidescape = mysqli_real_escape_string($conn, $_POST['uidmail']);
		$mailuid = str_replace(' ', '', $mailuidescape);
		$password = mysqli_real_escape_string($conn, $_POST['pwd']);
		$mail = $_POST['uidmail'];

		if (empty($mailuid) || empty($password)) {
			header("Location: ../login.php?error=emptyfields");
			exit();
		}
		else{
			$sql = "SELECT * FROM users WHERE email_Users=?;";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("Location: ../login.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt, "s", $mailuid);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if ($row = mysqli_fetch_assoc($result)) {
					$pwdCheck = password_verify($password, $row['pwd_Users']);
					if ($pwdCheck == false) {
						header("Location: ../login.php?Error=pwdErr&mail=".$mail."");
						exit();
					}
					else if($pwdCheck == true) {
						session_start();
						$_SESSION['userId'] = $row['id_Users'];
						$_SESSION['userUid'] = $row['first_Users'];
						header("Location: ../mainpage.php");
						exit();

					}else{
						header("Location: ../login.php");
						exit();
					}
				}
				else{
					header("Location: ../login.php?Error=usnErr");
					exit();
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}else {
		header("Location: ../mainpage.php");
		exit();
	}
