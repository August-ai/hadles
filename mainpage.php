<?php require "header.php"; ?>
  <div class="disposition-container">
    <div class="size-container">

  <div class="first-container-main">
    <?php
     require "m_carousel.org.php"
      ?>
  <!-- <div class="container-top2">
    <h2 class="centerize objectif-text main_sen">"Our Objectif,<br> Support Every Charitable Organization"</h2>
  </div> -->
  <br>
  <br>
  <br>
  <div class="container-choice">
    <h2 class="centerize sec_text">Choose an Organization</h2>
    <br>
    <br>
    <br>
    <br>
    <div class="">
      <h2 class="normal-text or-text">or</h2>
    </div>
      <br>
    <form class="find" action="findIdeal.php" method="post">
      <input type="submit" name="findasso" value="Find your Ideal Organization" class="signIn center-bt" id="find-bt">
    </form>
    <form id="give-rand" action="random.org.php" method="post">
      <input type="submit" name="give-rand" value="Give to a random association" class="signIn center-bt" id="give-rand-bt">
    </form>
  </div>
  <br>
  <br>
</div>
  <div class="suggestion-container">

    <?php require "suggestions.org.php"; ?>
  </div>
<?php require "footer.php"; ?>

<script type="text/javascript">


var pr = document.querySelector( '.paginate.left' );
var pl = document.querySelector( '.paginate.right' );

pr.onclick = slide.bind( this, -1 );
pl.onclick = slide.bind( this, 1 );

var index = 0, total = 5;

function slide(offset) {
index = Math.min( Math.max( index + offset, 0 ), total - 1 );

document.querySelector( '.counter' ).innerHTML = ( index + 1 ) + ' / ' + total;

pr.setAttribute( 'data-state', index === 0 ? 'disabled' : '' );
pl.setAttribute( 'data-state', index === total - 1 ? 'disabled' : '' );
}

slide(0);
</script>
