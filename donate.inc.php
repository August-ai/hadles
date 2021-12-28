<?php
session_start();

  if (isset($_POST['sumbit-login_payment'])) {
      if (isset($_SESSION['userId'])) {
        header('Location: ../payment.php');
        exit();
      }else{
        header('Location: ../login_payment.php?signincheckout&o='.$_GET["o"].'&donationamount='.$_POST["amount"].'');
        exit();
      }
  }

 ?>
