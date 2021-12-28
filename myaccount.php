<?php require "headerS.php"; ?>

<?php
  if (isset($_SESSION['userId'])) {
    echo '
    <div class="main-bg">
    <h2 id="P-AN">Hi ' . $_SESSION["userUid"] . '</h2>
    </div>
    <div id="rs-bg">
    <h3><a href="liked.php">Liked</a></h3>
    <h3><a href="liked.php">Donated</a></h3>
    <h3><a href="liked.php">Informations</a></h3>
    <h3><a href="liked.php">Liked Organizations</a></h3>
    </div>
    <form action="includes/logout.inc.php" method="post">
      <button type="submit" name="submit-logout" class="signIn" id="button4">Logout</button>
    </form>';
  }else {
    header("Location: mainpage.php");
    exit();
  }
   ?>

<?php require "footerS.php"; ?>
