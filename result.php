<?php
  if (isset($_POST["search"])) {
    header("Location: search.php?s=".$_POST['search']."");
    exit();
  }else {
    header("Location: mainpage.php");
    exit();
  }
 ?>
