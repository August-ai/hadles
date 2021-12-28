<?php require "headerS.php"; ?>

  <?php
    if (isset($_GET['first_name'])) {
      $fname = $_GET['first_name'];
    }else {
      $fname = '';
    }
    if (isset($_GET['last_name'])) {
      $lname = $_GET['last_name'];
    }else {
      $lname = '';
    }
    if (isset($_GET['mail'])) {
      $mname = $_GET['mail'];
    }else {
      $mname = '';
    }
   ?>

  <div class="signup-div">
    <h2 id="create-text">Create an account</h2>
    <hr id="f-hr">
    <form class="signup-form" action="includes/signup.inc.php" method="post">

      <div id="rec-line">
        <div class="full_name inp_si_sep">
          <label for="first_name" class="t_part_space">
            <span class="label_input_name">First Name</span>
            <?php echo '<input type="text" name="first_name" class="thetype t_part fst-name_input fst_input_nrm bot_marg-n" id="f_name" value='.$fname.'>'; ?>
            <p class="in_Err fn_inp_Err nagasaki">Enter your first name</p>
          </label>
          <label>
            <span class="label_input_name">Last Name</span>
            <?php echo '<input type="text" name="last_name" class="thetype t_part lst-name_input lst_input_nrm bot_marg-n" value='.$lname.'>'; ?>
            <p class="in_Err ln_inp_Err nagasaki">Enter your last name</p>
          </label>
        </div>
        <div class="inp_si_sep">
          <label class="f-label">Email</label>
          <br>
          <?php
            if (isset($_GET["errorS"]) && ($_GET["errorS"] == "invalidmail" ||$_GET["errorS"] == "emailtaken")) {
              echo '<input type="email" name="mail" class="thetype thetypeErr mail_input mail_input_nrm bot_marg-n">
              <p class="in_Err mail_inp_Err nagasaki">Enter your e-mail address</p>
              <p class="in_Err mail_inp_Err_inc">Invalid e-mail address</p>';
            }else {
              echo '<input type="email" name="mail" class="thetype mail_input mail_input_nrm bot_marg-n" value='.$mname.'>
              <p class="in_Err mail_inp_Err nagasaki">Enter your e-mail address</p>';
            }
           ?>

        </div>
        <div class="inp_si_sep">
          <label class="f-label">Password</label>
          <br>
          <input type="password" name="pwd" class="thetype pass_input pass_input_nrm bot_marg-n" placeholder="at least 6 characters">
          <p class="in_Err pass_inp_Err nagasaki">Enter your password</p>
          <p class="in_Err pass_inp_ErrL nagasaki">At least 6 characters</p>

        </div>
        <div class="inp_si_sep">
          <label class="f-label">Confirm Password</label>
          <br>
          <input type="password" name="pwd-repeat" class="thetype rpass_input rpass_input_nrm bot_marg-n">
          <p class="in_Err rpass_inp_Err nagasaki">Enter your password again</p>
          <p class="in_Err rpass_inp_ErrM nagasaki">Passwords do not match</p>

        </div>

        <button type="submit" name="signup-submit" class="signIn signup-bt">Create</button>
        <br>
        <p>By creating an account you agree to our <a href="extra/terms&privacy.php">terms&privacy</a></p>

      </div>
      <div class="existing_account">
      <p class="re-lo">Already have an account? <a href="login.php">Sign in</a></p>
    </div>
    </form>
  </div>

<?php require "footerS.php" ?>

<script src="jquery.min.js"></script>
<script>
  $(document).ready(function(){

    $('.signup-bt').on('click', function(){
        // var empty = true;
        $input_fn = $('.fst_input_nrm');
        $input_ln = $('.lst_input_nrm');

        $input_m = $('.mail_input_nrm');
        $input_p = $('.pass_input_nrm');
        $input_prpt = $('.rpass_input_nrm');


        $pfn_Err = $('.fn_inp_Err');
        $pln_Err = $('.ln_inp_Err');

        $pm_Err = $('.mail_inp_Err');
        $pm_ErrI = $('.mail_inp_Err_inc');

        $pp_Err = $('.pass_inp_Err');
        $pp_ErrL = $('.pass_inp_ErrL');

        $prp_Err = $('.rpass_inp_Err');
        $prp_ErrM = $('.rpass_inp_ErrM');
        //
        // $mmsg_Err = $('.mail_inp_Err_inc');
        // $pmsg_Err = $('.pass_inp_Err_inc');
        //
        // $mmsg_Err = $('.mail_inp_Err_inc');
        // $pmsg_Err = $('.pass_inp_Err_inc');
        // $pmsg_Err = $('.pass_inp_Err_inc');


               if(!$input_fn.val() && !$input_ln.val() && !$input_m.val() && !$input_p.val()){

                 $input_fn.addClass('thetypeErr');
                 $input_ln.addClass('thetypeErr');

                 $input_m.addClass('thetypeErr');
                 $input_p.addClass('thetypeErr');


                 $pfn_Err.removeClass('nagasaki');
                 $pln_Err.removeClass('nagasaki');
                 $pm_Err.removeClass('nagasaki');
                 $pp_Err.removeClass('nagasaki');

                 $pp_ErrL.addClass('nagasaki');
                 $pm_ErrI.addClass('nagasaki');


                 // $mmsg_Err.addClass('nagasaki');
                 // $pmsg_Err.addClass('nagasaki');

              }
              else if(!$input_ln.val() && !$input_m.val() && !$input_p.val()){

                $input_ln.addClass('thetypeErr');

                $input_m.addClass('thetypeErr');
                $input_p.addClass('thetypeErr');
                $input_prpt.removeClass('thetypeErr');
                $prp_Err.addClass('nagasaki');



                $pln_Err.removeClass('nagasaki');
                $pm_Err.removeClass('nagasaki');
                $pp_Err.removeClass('nagasaki');


                $input_fn.removeClass('thetypeErr');
                $pfn_Err.addClass('nagasaki');

                $pp_ErrL.addClass('nagasaki');
                $pm_ErrI.addClass('nagasaki');


                // $mmsg_Err.addClass('nagasaki');
                // $pmsg_Err.addClass('nagasaki');

             }else if(!$input_fn.val() && !$input_m.val() && !$input_p.val()){

               $input_fn.addClass('thetypeErr');

               $input_m.addClass('thetypeErr');
               $input_p.addClass('thetypeErr');


               $pfn_Err.removeClass('nagasaki');
               $pm_Err.removeClass('nagasaki');
               $pp_Err.removeClass('nagasaki');


               $input_ln.removeClass('thetypeErr');
               $pln_Err.addClass('nagasaki');

               $input_prpt.removeClass('thetypeErr');
               $prp_Err.addClass('nagasaki');

               $pp_ErrL.addClass('nagasaki');
               $pm_ErrI.addClass('nagasaki');


               // $mmsg_Err.addClass('nagasaki');
               // $pmsg_Err.addClass('nagasaki');

            }else if(!$input_fn.val() && !$input_ln.val() && !$input_p.val()){

              $input_fn.addClass('thetypeErr');

              $input_ln.addClass('thetypeErr');
              $input_p.addClass('thetypeErr');


              $pfn_Err.removeClass('nagasaki');
              $pln_Err.removeClass('nagasaki');
              $pp_Err.removeClass('nagasaki');


              $input_m.removeClass('thetypeErr');
              $pm_Err.addClass('nagasaki');

              $input_prpt.removeClass('thetypeErr');
              $prp_Err.addClass('nagasaki');

              $pp_ErrL.addClass('nagasaki');

              // $mmsg_Err.addClass('nagasaki');
              // $pmsg_Err.addClass('nagasaki');

           }else if(!$input_fn.val() && !$input_ln.val() && !$input_m.val()){

             $input_fn.addClass('thetypeErr');

             $input_ln.addClass('thetypeErr');
             $input_m.addClass('thetypeErr');


             $pfn_Err.removeClass('nagasaki');
             $pln_Err.removeClass('nagasaki');
             $pm_Err.removeClass('nagasaki');


             $input_p.removeClass('thetypeErr');
             $pp_Err.addClass('nagasaki');

             $input_prpt.removeClass('thetypeErr');
             $prp_Err.addClass('nagasaki');

             $pp_ErrL.addClass('nagasaki');
             $pm_ErrI.addClass('nagasaki');


             // $mmsg_Err.addClass('nagasaki');
             // $pmsg_Err.addClass('nagasaki');

          }else if(!$input_m.val() && !$input_p.val()){

               $input_m.addClass('thetypeErr');
               $input_p.addClass('thetypeErr');

               $pm_Err.removeClass('nagasaki');
               $pp_Err.removeClass('nagasaki');


               $input_fn.removeClass('thetypeErr');
               $pfn_Err.addClass('nagasaki');
               $input_ln.removeClass('thetypeErr');
               $pln_Err.addClass('nagasaki');

               $input_prpt.removeClass('thetypeErr');
               $prp_Err.addClass('nagasaki');

               $pp_ErrL.addClass('nagasaki');
               $pm_ErrI.addClass('nagasaki');

               // $mmsg_Err.addClass('nagasaki');
               // $pmsg_Err.addClass('nagasaki');

            }else if(!$input_fn.val() && !$input_ln.val()){

                 $input_fn.addClass('thetypeErr');
                 $input_ln.addClass('thetypeErr');

                 $pfn_Err.removeClass('nagasaki');
                 $pln_Err.removeClass('nagasaki');


                 $input_m.removeClass('thetypeErr');
                 $pfn_Err.removeClass('nagasaki');
                 $input_p.removeClass('thetypeErr');
                 $pln_Err.removeClass('nagasaki');

                 $input_prpt.removeClass('thetypeErr');
                 $prp_Err.addClass('nagasaki');

                 $pp_ErrL.addClass('nagasaki');
                 // $mmsg_Err.addClass('nagasaki');
                 // $pmsg_Err.addClass('nagasaki');

              }else if(!$input_fn.val() && !$input_p.val()){

                   $input_fn.addClass('thetypeErr');
                   $input_p.addClass('thetypeErr');

                   $pfn_Err.removeClass('nagasaki');
                   $pp_Err.removeClass('nagasaki');


                   $input_m.removeClass('thetypeErr');
                   $pfn_Err.removeClass('nagasaki');
                   $input_ln.removeClass('thetypeErr');
                   $pp_Err.removeClass('nagasaki');
                   $pln_Err.addClass('nagasaki');


                   $input_prpt.removeClass('thetypeErr');
                   $prp_Err.addClass('nagasaki');

                   $pp_ErrL.addClass('nagasaki');

                   // $mmsg_Err.addClass('nagasaki');
                   // $pmsg_Err.addClass('nagasaki');

                }else if(!$input_ln.val() && !$input_p.val()){

                     $input_ln.addClass('thetypeErr');
                     $input_p.addClass('thetypeErr');

                     $pln_Err.removeClass('nagasaki');
                     $pp_Err.removeClass('nagasaki');


                     $input_m.removeClass('thetypeErr');
                     $pm_Err.addClass('nagasaki');
                     $input_fn.removeClass('thetypeErr');
                     $pfn_Err.addClass('nagasaki');


                     $input_prpt.removeClass('thetypeErr');
                     $prp_Err.addClass('nagasaki');

                     $pp_ErrL.addClass('nagasaki');

                     // $mmsg_Err.addClass('nagasaki');
                     // $pmsg_Err.addClass('nagasaki');

              }else if(!$input_fn.val() && !$input_m.val()){

                   $input_fn.addClass('thetypeErr');
                   $input_m.addClass('thetypeErr');

                   $pfn_Err.removeClass('nagasaki');
                   $pm_Err.removeClass('nagasaki');


                   $input_p.removeClass('thetypeErr');
                   $pfn_Err.removeClass('nagasaki');
                   $input_ln.removeClass('thetypeErr');
                   $pln_Err.addClass('nagasaki');
                   $pm_Err.removeClass('nagasaki');
                   $pp_ErrL.addClass('nagasaki');



                   $input_prpt.removeClass('thetypeErr');
                   $prp_Err.addClass('nagasaki');
                   $pm_ErrI.addClass('nagasaki');

                   // $mmsg_Err.addClass('nagasaki');
                   // $pmsg_Err.addClass('nagasaki');

            }else if(!$input_ln.val() && !$input_m.val()){

                 $input_ln.addClass('thetypeErr');
                 $input_m.addClass('thetypeErr');

                 $pln_Err.removeClass('nagasaki');
                 $pm_Err.removeClass('nagasaki');


                 $input_p.removeClass('thetypeErr');
                 $pln_Err.removeClass('nagasaki');
                 $input_fn.removeClass('thetypeErr');
                 $pfn_Err.addClass('nagasaki');
                 $pm_Err.removeClass('nagasaki');



                 $input_prpt.removeClass('thetypeErr');
                 $prp_Err.addClass('nagasaki');

                 $pp_ErrL.addClass('nagasaki');
                 $pm_ErrI.addClass('nagasaki');


                 // $mmsg_Err.addClass('nagasaki');
                 // $pmsg_Err.addClass('nagasaki');

          }else if(!$input_fn.val()){

              $input_fn.addClass('thetypeErr');

              $pfn_Err.removeClass('nagasaki');
              $input_prpt.removeClass('thetypeErr');
              $prp_Err.addClass('nagasaki');

              $input_p.removeClass('thetypeErr');
              $pp_Err.addClass('nagasaki');
              $input_ln.removeClass('thetypeErr');
              $pln_Err.addClass('nagasaki');
              $input_m.removeClass('thetypeErr');
              $pm_Err.addClass('nagasaki');

              $pp_ErrL.addClass('nagasaki');

              // $mmsg_Err.addClass('nagasaki');
              // $pmsg_Err.addClass('nagasaki');

           }else if(!$input_ln.val()){

               $input_ln.addClass('thetypeErr');

               $pln_Err.removeClass('nagasaki');
               $input_prpt.removeClass('thetypeErr');
               $prp_Err.addClass('nagasaki');

               $input_p.removeClass('thetypeErr');
               $pp_Err.addClass('nagasaki');
               $input_fn.removeClass('thetypeErr');
               $pfn_Err.addClass('nagasaki');
               $input_m.removeClass('thetypeErr');
               $pm_Err.addClass('nagasaki');

               $pp_ErrL.addClass('nagasaki');

               // $mmsg_Err.addClass('nagasaki');
               // $pmsg_Err.addClass('nagasaki');

            }else if(!$input_m.val()){

                $input_m.addClass('thetypeErr');

                $pm_Err.removeClass('nagasaki');
                $input_prpt.removeClass('thetypeErr');
                $prp_Err.addClass('nagasaki');

                $input_p.removeClass('thetypeErr');
                $pp_Err.addClass('nagasaki');
                $input_fn.removeClass('thetypeErr');
                $pfn_Err.addClass('nagasaki');
                $input_ln.removeClass('thetypeErr');
                $pln_Err.addClass('nagasaki');

                $pp_ErrL.addClass('nagasaki');
                $pm_ErrI.addClass('nagasaki');


                // $mmsg_Err.addClass('nagasaki');
                // $pmsg_Err.addClass('nagasaki');

             }else if(!$input_p.val()){

              $input_p.addClass('thetypeErr');

              $pp_ErrL.addClass('nagasaki');

              $pp_Err.removeClass('nagasaki');
              $input_prpt.removeClass('thetypeErr');
              $prp_Err.addClass('nagasaki');

              $input_fn.removeClass('thetypeErr');
              $pfn_Err.addClass('nagasaki');
              $input_ln.removeClass('thetypeErr');
              $pln_Err.addClass('nagasaki');
              $input_m.removeClass('thetypeErr');
              $pm_Err.addClass('nagasaki');

              $pp_ErrL.addClass('nagasaki');

              // $mmsg_Err.addClass('nagasaki');
              // $pmsg_Err.addClass('nagasaki');

          }else if($input_p.val().length < 6 && $input_p.val().length > 0){
                   $input_p.addClass('thetypeErr');

                   $pp_ErrL.removeClass('nagasaki');
                   $pp_Err.addClass('nagasaki');

                   $input_prpt.removeClass('thetypeErr');
                   $prp_Err.addClass('nagasaki');

                   $input_fn.removeClass('thetypeErr');
                   $pfn_Err.addClass('nagasaki');
                   $input_ln.removeClass('thetypeErr');
                   $pln_Err.addClass('nagasaki');
                   $input_m.removeClass('thetypeErr');
                   $pm_Err.addClass('nagasaki');

                   // $mmsg_Err.addClass('nagasaki');
                   // $pmsg_Err.addClass('nagasaki');

                }
           else if(!$input_prpt.val()){

              $prp_Err.removeClass('nagasaki');
              $prp_ErrM.addClass('nagasaki');

              $input_prpt.addClass('thetypeErr');


              $input_fn.removeClass('thetypeErr');
              $pfn_Err.addClass('nagasaki');
              $input_ln.removeClass('thetypeErr');
              $pln_Err.addClass('nagasaki');
              $input_m.removeClass('thetypeErr');
              $pm_Err.addClass('nagasaki');
              $input_p.removeClass('thetypeErr');
              $pp_Err.addClass('nagasaki');

              $pp_ErrL.addClass('nagasaki');


              // $mmsg_Err.addClass('nagasaki');
              // $pmsg_Err.addClass('nagasaki');

            }else if($input_p.val() !== $input_prpt.val()){
               $prp_ErrM.removeClass('nagasaki');
               $prp_Err.addClass('nagasaki');

               $input_prpt.addClass('thetypeErr');

               $input_fn.removeClass('thetypeErr');
               $pfn_Err.addClass('nagasaki');
               $input_ln.removeClass('thetypeErr');
               $pln_Err.addClass('nagasaki');
               $input_m.removeClass('thetypeErr');
               $pm_Err.addClass('nagasaki');
               $input_p.addClass('thetypeErr');
               $pp_Err.addClass('nagasaki');
               $pp_ErrL.addClass('nagasaki');


               // $mmsg_Err.addClass('nagasaki');
               // $pmsg_Err.addClass('nagasaki');

             }else {
              return true;
            }
       return false;
    });
  });
</script>


<!--
  $_GET ERROR(DELETE LATER)


  // if (isset($_GET['errorS'])) {
  //   if ($_GET['errorS'] == "emptyfields") {
  //     echo "<p class='wrong'>Fill in all fields!</p>";
  //
  //   }elseif ($_GET['errorS'] == "invaliduidmail") {
  //     echo "<p class='wrong'>Invalid username and e-mail!</p>";
  //
  //   }elseif ($_GET['errorS'] == "invaliduid") {
  //     echo "<p class='wrong'>Invalid username!</p>";
  //
  //   }elseif ($_GET['errorS'] == "invalidmail") {
  //     echo "<p class='wrong'>Invalid e-mail!</p>";
  //
  //   }elseif ($_GET['errorS'] == "passwordcheck") {
  //     echo "<p class='wrong'>Your password do not match!</p>";
  //
  //   }elseif ($_GET['errorS'] == "usertaken") {
  //     echo "<p class='wrong'>Username is already taken!</p>";
  //   }
  //   elseif ($_GET['errorS'] == "emailtaken") {
  //     echo "<p class='wrong'>Email is already taken!</p>";
  //   }
  // }else if (isset($_GET['signup']) == "success") {
  //   echo "<p class='success'>Signup successful!</p>";
  // }
 -->
