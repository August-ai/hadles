<?php require "headerS.php" ?>

<?php

if (isset($_GET["Error"])) {
  if ($_GET["Error"] == "usnErr") {
  }
}

 ?>

    <br>
    <div class="container-1">
    <br>
    <h1 id="create-text">Connect to your account</h1>
    <br>
    <hr id="f-hr"/>
    <?php echo "<form action='includes/login_payment.inc.php?signincheckout&o=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."' method='post' >"; ?>
      <div id="rec-line3">
        <div class="input_s_spr">
          <label class="f-label">Email</label>
          <?php
          if (isset($_GET["Error"]) && $_GET["Error"] == "usnErr") {
            echo '<input type="text" name="uidmail" class="thetype thetypeErr mail_input mail_input_nrm" id="s1" placeholder="email@example.com">
            <p class="in_Err mail_inp_Err nagasaki">Enter your e-mail address</p>
            <p class="in_Err mail_inp_Err_inc">Incorrect e-mail address</p>';
          }else if (isset($_GET["Error"]) && isset($_GET["mail"]) && $_GET["Error"] == "pwdErr") {
            echo '<input type="text" name="uidmail" class="thetype mail_input mail_input_nrm" id="s1" placeholder="email@example.com" value='.$_GET["mail"].'>
            <p class="in_Err mail_inp_Err nagasaki">Enter your e-mail address</p>';
          }
          else {
            echo '<input type="text" name="uidmail" class="thetype mail_input mail_input_nrm" id="s1" placeholder="email@example.com">
              <p class="in_Err mail_inp_Err nagasaki">Enter your e-mail address</p>';
          }
           ?>

        </div>

        <div class="input_s_spr">
          <div class="second-row">
            <div id="second-row_password">
              <label class="fl f-label">Password</label>
            </div>
            <div id="second-row_forgot">
              <a id="forgot" href="extra/forgot.php" target="_blank">Forgot password?</a>
            </div>
          </div>
          <?php
          if (isset($_GET["Error"]) && isset($_GET["mail"]) && $_GET["Error"] == "pwdErr") {
            echo '<input type="password" name="pwd"class="thetype thetypeErr pass_input pass_input_nrm"id="s2" placeholder="*******">
            <p class="in_Err pass_inp_Err nagasaki">Enter your password</p>
            <p class="in_Err pass_inp_Err_inc">Incorrect password</p>';
          }else {
            echo '<input type="password" name="pwd"class="thetype pass_input pass_input_nrm"id="s2" placeholder="*******">
            <p class="in_Err pass_inp_Err nagasaki">Enter your password</p>';
          }
           ?>
        </div>

        <button type="submit" name="submit-login" class="button button_cont" id="button3">Sign in</button>
      </div>
    </form>
    <div class="existing_account">
    <?php echo "<p class='re-lo'>New to Hadles? <a href='signuppayment.php?signincheckout&o=".$_GET['o']."&donationamount=".$_GET['donationamount']."&donation=".$_GET['donation']."&rest=".$_GET['rest']."'>Create an account</a></p>"; ?>
  </div>
  <br>
<div id="rec-line4">

 </div>
</div>

<?php require "footerS.php"; ?>

<script src="jquery.min.js"></script>
<script>
  $(document).ready(function(){

    $('.button_cont').on('click', function(){
        // var empty = true;
        $input_m = $('.mail_input_nrm');
        $input_p = $('.pass_input_nrm');
        $pm_Err = $('.mail_inp_Err');
        $pp_Err = $('.pass_inp_Err');
        $mmsg_Err = $('.mail_inp_Err_inc');
        $pmsg_Err = $('.pass_inp_Err_inc');



               if(!$('.mail_input_nrm').val() && !$('.pass_input_nrm').val()){

                 $input_m.addClass('thetypeErr');
                 $input_p.addClass('thetypeErr');

                 $pm_Err.removeClass('nagasaki');
                 $pp_Err.removeClass('nagasaki');

                 $mmsg_Err.addClass('nagasaki');
                 $pmsg_Err.addClass('nagasaki');

              }else if(!$('.mail_input_nrm').val()){
                $input_m.addClass('thetypeErr');

                $pm_Err.removeClass('nagasaki');
                $pp_Err.addClass('nagasaki');

                $input_p.removeClass('thetypeErr');

                $mmsg_Err.addClass('nagasaki');
                $pmsg_Err.addClass('nagasaki');
             }else if(!$('.pass_input_nrm').val()){
               $input_m.removeClass('thetypeErr');
               $input_p.addClass('thetypeErr');

               $pp_Err.removeClass('nagasaki');
               $pm_Err.addClass('nagasaki');

               $mmsg_Err.addClass('nagasaki');
               $pmsg_Err.addClass('nagasaki');

            }else {
              return true;
            }
       return false;
    });
  });
</script>
