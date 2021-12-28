<?php

  require "headerDonate.php";
  if ($queryResult == 1) {
    echo '<h1>Donating to <a href="check.org.php?o='.$organization.'">'.$organization.'</a></h1>
    <Br>
    <br>
    <div class="amount-div">
      <h2 class="">Donatation amount:</h2>
      <Br>
      <button class="signIn amount-bt act"id="amount-bt1"onclick="addclass1()">25$</button><br>
      <button class="signIn amount-bt" id="amount-bt2" onclick="addclass2()">50$</button><br>
      <button class="signIn amount-bt" id="amount-bt3" onclick="addclass3()">100$</button><br>
      <button class="signIn amount-bt" id="amount-bt4" onclick="addclass4()">250$</button><br>
      </div>';

      if (isset($_SESSION["userId"])) {
        echo '<form class="center-f" action="payment.php?action=checkout&session='.$_GET["o"].'" method="POST">
          <div class="donate-container">

            <div class="separate-m-s">

              <label class="s-donation">
                <input class="nagasaki" id="dS" type="radio" name="donationG" value="Single" checked="check">
                <span class="signIn act-s" id="s-donation-bt" onclick="addclassS()">Single</span>
              </label>

                <label class="m-donation">
                  <input class="nagasaki" id="dM" type="radio" value="Monthly" name="donationG">
                  <span class="signIn" id="m-donation-bt" onclick="addclassM()">Give Monthly</span>
                </label>

              </div>
              <div>
        	<div class="container__item">
          <div class="flex">
                    <span class="currency">$</span>
                    <input type="text" autocomplete="off" id="input_amount" class="form__field" placeholder="Amount" name="amount"  maxlength="10" value="25" />
                    <button type="button" class="btn btn--primary btn--inside uppercase">CAN</button>
                </div>
        	</div>

        	<div class="container__item container__item--bottom">
        	</div>
        </div>
        <div class="cntr t-checkbox">
            <label for="cbx" class="label-cbx">
              <input id="cbx" type="checkbox" name="donation-checkbox" class="invisible">
              <div class="checkbox">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                  <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                  <polyline points="4 11 8 15 16 6"></polyline>
                </svg>
              </div>
              <span class="checkbox-text pourcentage_text">Give 100% of my donation, by adding $<span class="span_prc" id="span_prcid">1.50</span> to cover all other costs</span>

            </label>
          </div>
          <div class="center-btn">
          <div class="box-3">
          <button name="sumbit-login_payment">
        <div class="btn-next btn-three">
        <span>NEXT</span>
        </button>
        </div>
        </div>
      </form>
    </div>';
  }else if (!isset($_SESSION["userId"])) {
    echo '<form class="center-f" action="login_payment.php?signincheckout&o='.$_GET["o"].'" method="POST">
    <div class="donate-container">

      <div class="separate-m-s">

        <label class="s-donation">
          <input class="nagasaki" id="dS" type="radio" name="donationG" value="Single" checked="check">
          <span class="signIn act-s" id="s-donation-bt" onclick="addclassS()">Single</span>
        </label>

          <label class="m-donation">
            <input class="nagasaki" id="dM" type="radio" value="Monthly" name="donationG">
            <span class="signIn" id="m-donation-bt" onclick="addclassM()">Give Monthly</span>
          </label>

        </div>
        <div>
    <div class="container__item">
    <div class="flex">
              <span class="currency">$</span>
              <input type="text" autocomplete="off" id="input_amount" class="form__field" placeholder="Amount" name="amount"  maxlength="10" value="25" />
              <button type="button" class="btn btn--primary btn--inside uppercase">CAN</button>
          </div>
    </div>

    <div class="container__item container__item--bottom">
    </div>
  </div>
  <div class="cntr t-checkbox">
      <label for="cbx" class="label-cbx">
        <input id="cbx" type="checkbox" name="donation-checkbox" class="invisible">
        <div class="checkbox">
          <svg width="20px" height="20px" viewBox="0 0 20 20">
            <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
            <polyline points="4 11 8 15 16 6"></polyline>
          </svg>
        </div>
        <span class="checkbox-text pourcentage_text">Give 100% of my donation, by adding $<span class="span_prc" id="span_prcid">1.50</span> to cover all other costs</span>
      </label>
    </div>
    <div class="center-btn">
    <div class="box-3">
    <button name="sumbit-login_payment">
  <div class="btn-next btn-three">
  <span>NEXT</span>
  </button>
  </div>
  </div>
  </form>
</div>';
  }
}else{
    echo "Something got wrong, we'll try to fix it as soon as possible";
  }

 ?>
 <script src="jquery.min.js"></script>
 <script>
     // when the user clicks on like
// pourcentage_text
     // when the user clicks on unlike
     function formatMoney(n, c, d, t) {
  var c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;

  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

     $('#input_amount').on('keyup',function( event ) {
       // alert("d");
       var init = $( "#input_amount" ).val()
       var value = (($( "#input_amount" ).val())/100)*6;
      $( ".span_prc" ).html(formatMoney(value));

      });



 </script>

 <script>
 const element1 = document.querySelector("#amount-bt1");
 const element2 = document.querySelector("#amount-bt2");
 const element3 = document.querySelector("#amount-bt3");
 const element4 = document.querySelector("#amount-bt4");
 const elementS = document.querySelector("#s-donation-bt");
 const elementM = document.querySelector("#m-donation-bt");

  function addclass1(){
    var element = document.getElementById("amount-bt1");
      element2.classList.remove("act");
      element3.classList.remove("act");
      element4.classList.remove("act");
    element.classList.add("act");
    document.getElementById("input_amount").value = "25";

    document.getElementById("span_prcid").innerHTML = "1.50";
  }
  function addclass2(){
    var element = document.getElementById("amount-bt2");
      element1.classList.remove("act");
      element3.classList.remove("act");
      element4.classList.remove("act");
    element.classList.add("act");
    document.getElementById("input_amount").value = "50";

    document.getElementById("span_prcid").innerHTML = "3.00";

  }
  function addclass3(){
    var element = document.getElementById("amount-bt3");
      element2.classList.remove("act");
      element1.classList.remove("act");
      element4.classList.remove("act");
    element.classList.add("act");
    document.getElementById("input_amount").value = "100";

    document.getElementById("span_prcid").innerHTML = "6.00";

  }
  function addclass4(){
    var element = document.getElementById("amount-bt4");
      element2.classList.remove("act");
      element3.classList.remove("act");
      element1.classList.remove("act");
    element.classList.add("act");
    document.getElementById("input_amount").value = "250";

    document.getElementById("span_prcid").innerHTML = "15.00";

  }

  function addclassS(){
      elementM.classList.remove("act-g");
    elementS.classList.add("act-s");
  }
  function addclassM(){
      elementS.classList.remove("act-s");
    elementM.classList.add("act-g");
  }
 </script>
