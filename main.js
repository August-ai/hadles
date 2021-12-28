
    document.querySelector("#top-arrw-div").addEventListener("click", function(){
    document.querySelector(".tab_arr_disp").style.display = "block";
    document.querySelector("#top-arrw-div").style.display = "none";
    document.querySelector("#top-arrw-div-re").style.display = "block";
  });

  document.querySelector("#top-arrw-div-re").addEventListener("click", function(){
  document.querySelector(".tab_arr_disp").style.display = "none";
  document.querySelector("#top-arrw-div").style.display = "block";
  document.querySelector("#top-arrw-div-re").style.display = "none";
});
//
//   $(document).click(function() {
    // document.querySelector(".tab_arr_disp").style.display = "none";
    // document.querySelector("#top-arrw-div").style.display = "block";
    // document.querySelector("#top-arrw-div-re").style.display = "none";
// });
$('body').click(function(evt){
       if(evt.target.id == "tab_arr_disp-id")
          return;
       //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
       if($(evt.target).closest('#tab_arr_disp-id').length)
          return;
          document.querySelector(".tab_arr_disp").style.display = "none";
          document.querySelector("#top-arrw-div").style.display = "block";
          document.querySelector("#top-arrw-div-re").style.display = "none";
      //Do processing of click event here for every element except with id menu_content

});

$(".top-arrw-position").click(function(e) {
    e.stopPropagation(); // This is the preferred method.
    return false;        // This should not be used unless you do not want
                         // any click events registering inside the div
});

// function class_dis(){
//   document.querySelector(".tab_arr_disp").style.display = "block";
//   document.querySelector("#top-arrw-div").style.display = "none";
//   document.querySelector("#top-arrw-div-re").style.display = "block";
// }
// function class_disre(){
//   document.querySelector(".tab_arr_disp").style.display = "none";
//   document.querySelector("#top-arrw-div").style.display = "block";
//   document.querySelector("#top-arrw-div-re").style.display = "none";
//
// }
