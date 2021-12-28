<?php require "header.php"; ?>

<div class="mid-cont">
  <div class="marg_cons-div">
    <h2>Your Wallet</h2>

      <p>empty wallet <a href="#">add a card</a> </p>

      <?php
      echo '<div class="main-payement-container">
        <div class="checkout-container chck-out_adapted_cont">
          <div class="checkout adapted_chkout-p">
            <form action="payment.inc.php" method="post" class="formp" autocomplete="off" novalidate>
        <div class="">
            <div class="main_row_card_fields reduced_marg-b">
              <div class="row adap-row">
              <div class="container_card">
                <div class="col-3 card_number_space all_share-carstics">
                    <input class="adapt-effect input-cart-number" type="num" placeholder="Card Number" id="card-number" maxlength="19">
                  </div>
                </div>
              </div>
                <!-- <label for="card-holder">Card holder</label>
                <input type="text" id="card-holder" /> -->
                <div class="row full_name row_space adap-row">
                <div class="container_card">
                  <div class="col-3 t_part_name all_share-carstics">
                      <input class="adapt-effect" type="num" placeholder="First Name" id="card-holder_first_name" maxlength="16">
                    </div>
                    <div class="col-3 t_part_name all_share-carstics">
                        <input class="adapt-effect" type="num" placeholder="Last Name" id="card-holder_last_name" maxlength="16">
                      </div>
                  </div>
                </div>
              <div class="row row_space adap-row">
              <div class="container_card">
                <div class="col-3 t_part_name all_share-carstics">
                    <input class="adapt-effect sml_inp" type="num" placeholder="mm/yy" id="expire_date" maxlength="5">
                  </div>
                  <div class="col-3 t_part_name all_share-carstics">
                      <input class="adapt-effect sml_inp" type="num" placeholder="CCV" id="card-ccv" maxlength="4">
                    </div>
                </div>
              </div>
            </div>
            <button class="btnp reduced_marg-b reduc_bt"><i class="fa fa-lock"></i> Done</button>
        </div>
        </form>
      </div>
        </div>
        <br>
        <br>




        <div>
        <div class="credit-card-box">
          <div class="flip">
            <div class="front">
              <div class="chip"></div>
              <div class="logo">
                <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                  <g>
                    <g>
                      <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z"/>
                               <img src="img/MasterCard_Logo.svg.png" alt="" style="width: 100px; height: auto; margin-top:-80px;margin-left:-40px;">

                    </g>
                  </g>
                </svg>
              </div>
              <div class="number"></div>
              <div class="card-holder">
                <label>Card holder</label>
                <div></div>
              </div>
              <div class="card-expiration-date">
                <label>Expires</label>
                <div></div>
              </div>
            </div>
            <div class="back">
              <div class="strip"></div>
              <div class="logo">
                <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                  <g>
                    <g>
                      <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z"/>
                               <img src="img/MasterCard_Logo.svg.png" alt="" style="width: 75px; height: auto; margin-top:-100px;margin-left:-10px;">
                    </g>
                  </g>
                </svg>

              </div>
              <div class="ccv">
                <label>CCV</label>
                <div></div>
              </div>
            </div>
          </div>
        </div>



        <div class="credit-card-box">
          <div class="flip">
            <div class="front">
              <div class="chip"></div>
              <div class="logo">
                <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                  <g>
                    <g>
                      <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z"/>
                               <img src="img/MasterCard_Logo.svg.png" alt="" style="width: 100px; height: auto; margin-top:-80px;margin-left:-40px;">

                    </g>
                  </g>
                </svg>
              </div>
              <div class="number"></div>
              <div class="card-holder">
                <label>Card holder</label>
                <div></div>
              </div>
              <div class="card-expiration-date">
                <label>Expires</label>
                <div></div>
              </div>
            </div>
            <div class="back">
              <div class="strip"></div>
              <div class="logo">
                <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                  <g>
                    <g>
                      <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z"/>
                               <img src="img/MasterCard_Logo.svg.png" alt="" style="width: 75px; height: auto; margin-top:-100px;margin-left:-10px;">
                    </g>
                  </g>
                </svg>

              </div>
              <div class="ccv">
                <label>CCV</label>
                <div></div>
              </div>
            </div>
          </div>
        </div>


        <div class="credit-card-box">
          <div class="flip">
            <div class="front">
              <div class="chip"></div>
              <div class="logo">
                <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                  <g>
                    <g>
                      <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z"/>
                               <img src="img/MasterCard_Logo.svg.png" alt="" style="width: 100px; height: auto; margin-top:-80px;margin-left:-40px;">

                    </g>
                  </g>
                </svg>
              </div>
              <div class="number"></div>
              <div class="card-holder">
                <label>Card holder</label>
                <div></div>
              </div>
              <div class="card-expiration-date">
                <label>Expires</label>
                <div></div>
              </div>
            </div>
            <div class="back">
              <div class="strip"></div>
              <div class="logo">
                <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                  <g>
                    <g>
                      <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z"/>
                               <img src="img/MasterCard_Logo.svg.png" alt="" style="width: 75px; height: auto; margin-top:-100px;margin-left:-10px;">
                    </g>
                  </g>
                </svg>

              </div>
              <div class="ccv">
                <label>CCV</label>
                <div></div>
              </div>
            </div>
          </div>
        </div>
        </div>










      </div>';
     ?>

  </div>
</div>
<?php require "footer.php"; ?>

<script type="text/javascript">
$('.input-cart-number').on('keyup change', function(){
$t = $(this);

if ($t.val().length > 4) {
  $t.next().focus();
}

var card_number = '';
$('.input-cart-number').each(function(){
  card_number += $(this).val() + ' ';
  if ($(this).val().length == 4) {
    $(this).next().focus();
  }
})

$('.credit-card-box .number').html(card_number);
});

$('#card-holder_first_name').on('keyup change', function(){
$t = $(this);
$a = $('#card-holder_last_name');
$('.credit-card-box .card-holder div').html(($t.val())+' '+($a.val()));
});
$('#card-holder_last_name').on('keyup change', function(){
$a = $(this);
$t = $('#card-holder_first_name');
$('.credit-card-box .card-holder div').html(($t.val())+' '+($a.val()));
});
// $('#card-holder_last_name').on('keyup change', function(){
// $ta = $(this);
// $('.credit-card-box .card-holder div').html($t.val());
// });

$('#expire_date').on('keyup change', function(){
$a = $(this);
$('.credit-card-box .card-expiration-date div').html($a.val());
});


$('#card-ccv').on('focus', function(){
$('.credit-card-box').addClass('hover');
}).on('blur', function(){
$('.credit-card-box').removeClass('hover');
}).on('keyup change', function(){
$('.ccv div').html($(this).val());
});

/*function getCreditCardType(accountNumber) {
if (/^5[1-5]/.test(accountNumber)) {
  result = 'mastercard';
} else if (/^4/.test(accountNumber)) {
  result = 'visa';
} else if ( /^(5018|5020|5038|6304|6759|676[1-3])/.test(accountNumber)) {
  result = 'maestro';
} else {
  result = 'unknown'
}
return result;
}

$('#card-number').change(function(){
console.log(getCreditCardType($(this).val()));
})*/
</script>
