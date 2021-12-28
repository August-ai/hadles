<?php require "header.php" ?>

<div class="main-donate-container">
  <br><br>
  <h1 class="normal-text centerize">Find Your Ideal Organization</h1>
  <hr class="under-l">
  <br><br>
  <div class="inside-donate-container1">
    <br>
    <!-- <h2 class="normal-text centerize">First Step: Know What You Want</h2> -->
    <br>
    <br>
    <!-- <div class="container">
        <div class="progress">
        <div class="progress-track"></div>
        <div id="step1" class="progress-step">
          Step One
        </div>
        <div id="step2" class="progress-step">
          Step Two
        </div>
      </div> -->
      <form class="" action="findIdeal.inc.php" method="post">

      <div class="block_separator">
        <div class="donate-selection">
          <h3 class="info-text location-text" id="help-text">Healping in: </h3>
          <div class="cont_heg_50"></div>

            <div class="cont_select_center" id="select1">

              <!-- Custom select structure -->
            <div class="select_mate" data-mate-select="active" >
            <select name="location" onchange="" onclick="return false;" id="">
              <option value=""  >-Select Location- </option>
              <option value="all the world">All the world</option>
              <option value="africa">Africa</option>
              <option value="north America">North America</option>
              <option value="south America">South America</option>
              <option value="asia">Asia</option>
              <option value="australia">Australia</option>
              <option value="europa">Europa</option>
            </select>
            <p class="selecionado_opcion"  onclick="open_select(this)" ></p><span onclick="open_select(this)" class="icon_select_mate" ><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/>
                <path d="M0-.75h24v24H0z" fill="none"/>
            </svg></span>
            <div class="cont_list_select_mate">
              <ul class="cont_select_int">  </ul>
            </div>
              </div>
              <!-- Custom select structure -->
            </div> <!-- End div center   -->
        </div>
      </div>
      <div class="block_separator">
        <div class="donate-selection">
          <h3 class="info-text location-text">Fight For: </h3>
          <div class="cont_heg_50"></div>

            <div class="cont_select_center">

              <!-- Custom select structure -->
            <div class="select_mate" data-mate-select="active" >
            <select name="fight" onchange="" onclick="return false;" id="">
              <option value=""  >-Select Fight- </option>
              <option value="poverty">Only Poverty</option>
              <option value="hunger">Only Hunger</option>
              <option value="hunger&poverty">Hunger and Poverty</option>
              <option value="abusation">Abusation</option>
              <option value="disease">Disease</option>
            </select>
            <p class="selecionado_opcion"  onclick="open_select(this)" ></p><span onclick="open_select(this)" class="icon_select_mate" ><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/>
                <path d="M0-.75h24v24H0z" fill="none"/>
            </svg></span>
            <div class="cont_list_select_mate">
              <ul class="cont_select_int">  </ul>
            </div>
              </div>
              <!-- Custom select structure -->
            </div> <!-- End div center   -->
        </div>
      </div>
      <div class="donate-selection">

        <div class="cont_heg_50"></div>
        <h3 class="info-text">Type of Association: </h3>
          <div class="cont_select_center">

            <!-- Custom select structure -->
          <div class="select_mate" data-mate-select="active" >
          <select name="type" onchange="" onclick="return false;" id="">
          <option value=""  >-Select Type- </option>
          <option value="Large">Large Organization</option>
          <option value="Medium" >Medium Organization</option>
          <option value="Small">Small Organization</option>
            </select>
          <p class="selecionado_opcion"  onclick="open_select(this)" ></p><span onclick="open_select(this)" class="icon_select_mate" ><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"/>
              <path d="M0-.75h24v24H0z" fill="none"/>
          </svg></span>
          <div class="cont_list_select_mate">
            <ul class="cont_select_int">  </ul>
          </div>
            </div>
            <!-- Custom select structure -->
          </div> <!-- End div center   -->
      </div>
    <button onClick=next() class="button-next signIn" type="submit" name="find-org">Next Step</button>
    <!-- </div> -->
    </form>
  </div>
</div>
<script type="text/javascript">
// let step = 'step1';
//
// const step1 = document.getElementById('step1');
// const step2 = document.getElementById('step2');
//
// function next() {
// if (step === 'step1') {
//   step = 'step2';
//   step1.classList.remove("is-active");
//   step1.classList.add("is-complete");
//   step2.classList.add("is-active");
//
// } else if (step === 'step2') {
//   step = 'step3';
//   step2.classList.remove("is-active");
//   step2.classList.add("is-complete");
//   step3.classList.add("is-active");
//
// }
// }
window.onload = function(){
  crear_select();
}

function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
};


var li = new Array();
function crear_select(){
var div_cont_select = document.querySelectorAll("[data-mate-select='active']");
var select_ = '';
for (var e = 0; e < div_cont_select.length; e++) {
div_cont_select[e].setAttribute('data-indx-select',e);
div_cont_select[e].setAttribute('data-selec-open','false');
var ul_cont = document.querySelectorAll("[data-indx-select='"+e+"'] > .cont_list_select_mate > ul");
 select_ = document.querySelectorAll("[data-indx-select='"+e+"'] >select")[0];
 if (isMobileDevice()) {
select_.addEventListener('change', function () {
 _select_option(select_.selectedIndex,e);
});
 }
var select_optiones = select_.options;
document.querySelectorAll("[data-indx-select='"+e+"']  > .selecionado_opcion ")[0].setAttribute('data-n-select',e);
document.querySelectorAll("[data-indx-select='"+e+"']  > .icon_select_mate ")[0].setAttribute('data-n-select',e);
for (var i = 0; i < select_optiones.length; i++) {
li[i] = document.createElement('li');
if (select_optiones[i].selected == true || select_.value == select_optiones[i].innerHTML ) {
li[i].className = 'active';
document.querySelector("[data-indx-select='"+e+"']  > .selecionado_opcion ").innerHTML = select_optiones[i].innerHTML;
};
li[i].setAttribute('data-index',i);
li[i].setAttribute('data-selec-index',e);
// funcion click al selecionar
li[i].addEventListener( 'click', function(){  _select_option(this.getAttribute('data-index'),this.getAttribute('data-selec-index')); });


li[i].innerHTML = select_optiones[i].innerHTML;
ul_cont[0].appendChild(li[i]);

    }; // Fin For select_optiones
  }; // fin for divs_cont_select
} // Fin Function



var cont_slc = 0;
function open_select(idx){
var idx1 =  idx.getAttribute('data-n-select');
  var ul_cont_li = document.querySelectorAll("[data-indx-select='"+idx1+"'] .cont_select_int > li");
var hg = 0;
var slect_open = document.querySelectorAll("[data-indx-select='"+idx1+"']")[0].getAttribute('data-selec-open');
var slect_element_open = document.querySelectorAll("[data-indx-select='"+idx1+"'] select")[0];
 if (isMobileDevice()) {
  if (window.document.createEvent) { // All
  var evt = window.document.createEvent("MouseEvents");
  evt.initMouseEvent("mousedown", false, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
	slect_element_open.dispatchEvent(evt);
} else if (slect_element_open.fireEvent) { // IE
  slect_element_open.fireEvent("onmousedown");
}else {
  slect_element_open.click();
}
}else {


  for (var i = 0; i < ul_cont_li.length; i++) {
hg += ul_cont_li[i].offsetHeight;
};
 if (slect_open == 'false') {
 document.querySelectorAll("[data-indx-select='"+idx1+"']")[0].setAttribute('data-selec-open','true');
 document.querySelectorAll("[data-indx-select='"+idx1+"'] > .cont_list_select_mate > ul")[0].style.height = hg+"px";
 document.querySelectorAll("[data-indx-select='"+idx1+"'] > .icon_select_mate")[0].style.transform = 'rotate(180deg)';
}else{
 document.querySelectorAll("[data-indx-select='"+idx1+"']")[0].setAttribute('data-selec-open','false');
 document.querySelectorAll("[data-indx-select='"+idx1+"'] > .icon_select_mate")[0].style.transform = 'rotate(0deg)';
 document.querySelectorAll("[data-indx-select='"+idx1+"'] > .cont_list_select_mate > ul")[0].style.height = "0px";
 }
}

} // fin function open_select

function salir_select(indx){
var select_ = document.querySelectorAll("[data-indx-select='"+indx+"'] > select")[0];
 document.querySelectorAll("[data-indx-select='"+indx+"'] > .cont_list_select_mate > ul")[0].style.height = "0px";
document.querySelector("[data-indx-select='"+indx+"'] > .icon_select_mate").style.transform = 'rotate(0deg)';
 document.querySelectorAll("[data-indx-select='"+indx+"']")[0].setAttribute('data-selec-open','false');
}


function _select_option(indx,selc){
 if (isMobileDevice()) {
selc = selc -1;
}
    var select_ = document.querySelectorAll("[data-indx-select='"+selc+"'] > select")[0];

  var li_s = document.querySelectorAll("[data-indx-select='"+selc+"'] .cont_select_int > li");
  var p_act = document.querySelectorAll("[data-indx-select='"+selc+"'] > .selecionado_opcion")[0].innerHTML = li_s[indx].innerHTML;
var select_optiones = document.querySelectorAll("[data-indx-select='"+selc+"'] > select > option");
for (var i = 0; i < li_s.length; i++) {
if (li_s[i].className == 'active') {
li_s[i].className = '';
};
li_s[indx].className = 'active';

};
select_optiones[indx].selected = true;
  select_.selectedIndex = indx;
  select_.onchange();
  salir_select(selc);

}
</script>

<?php require "footerS.php" ?>
