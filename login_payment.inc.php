<?php
if (!isset($_SESSION['userId'])) {
			require 'dbh.inc.php';

			$mail = $_POST['uidmail'];
			$mailuidescape = mysqli_real_escape_string($conn, $_POST['uidmail']);
			$mailuid = str_replace(' ', '', $mailuidescape);
			$password = mysqli_real_escape_string($conn, $_POST['pwd']);

			if (empty($mailuid) || empty($password)) {
				header("Location: ../login_pay.php?error=emptyfields&action=ckeckoutsession&o=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
				exit();
			}
			else{
				$sql = "SELECT * FROM users WHERE email_Users=?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location: ../login_pay.php?error=sqlerror");
					exit();
				}else{
					mysqli_stmt_bind_param($stmt, "s", $mailuid);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if ($row = mysqli_fetch_assoc($result)) {
						$pwdCheck = password_verify($password, $row['pwd_Users']);
						if ($pwdCheck == false) {
							header("Location: ../login_pay.php?Error=pwdErr&mail=".$mail."&action=ckeckoutsession&o=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
							exit();
						}
						else if($pwdCheck == true) {
							session_start();
							$_SESSION['userId'] = $row['id_Users'];
							$_SESSION['userUid'] = $row['first_Users'];

							$donationA = mysqli_real_escape_string($conn, $_GET['amount']);

							header("Location: ../paymentS.php?action=ckeckout&session=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
							exit();

						}else{
							header("Location: ../login_pay.php?error=wrongpwd|email&action=ckeckoutsession&o=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
							exit();
						}
					}
					else{
						header("Location: ../login_pay.php?Error=usnErr&action=ckeckoutsession&o=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."");
						exit();
					}
				}
			}
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
	}
