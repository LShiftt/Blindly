<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Musiswipe");

if (!isset($_SESSION['liked'])) {
  $_SESSION['liked'] = '';
}

if (!isset($_SESSION['disliked'])) {
  $_SESSION['disliked'] = '';
}
// $_SESSION['liked'] = '2/3/4';
// $_SESSION['disliked'] = '1/5';
// dump($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['liked'])) {

  $_SESSION['liked'] .= "/" . strval($_GET['liked']);
  // dump($_SESSION);

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['disliked'])) {

  $_SESSION['disliked'] .= "/" . strval($_GET['disliked']);
  // dump($_SESSION);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['reset'])) {

  $_SESSION['liked'] = '';
  $_SESSION['disliked'] = '';

}



?>


<!-- offline -->

<div id="offlineDiv" style="display: none;">
    <p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
    <div id="target">
        <p id="state"></p>
    </div>
    <img id="offlineImage" src="../media/img/vinyleImg.png" alt='vinyle'>
    <div id="offline--song">
        <?php search($dbh, $_SESSION['liked']); ?>
    </div>
</div>




<form id="saveLiked" action="" method="get">
  <input id="liked" type="hidden" name="liked" value="">
  <input id="disliked" type="hidden" name="disliked" value="">
</form>
<!-- <form action="" method="get">
  <input id="disliked" type="hidden" name="reset" value="1">
  <button type="submit">Reset liked et disliked</button>
</form> -->

<!-- <input id="la"></input>
<input id="le"></input> -->


<main class="musiSwipe--song">   
    <h1>Musi<span>Swipe</span></h1>
    <?php 
        $id = tinder($dbh, $_SESSION['liked'], $_SESSION['disliked']);
    ?>
      <div class="musiSwipe--song--btn">
        <a href="./musiswipe.php?disliked=<?= $id ?>" class="musiSwipe--song--btn--link"><i class="fa-solid fa-x"></i></a>
        <a href="./musiswipe.php?liked=<?= $id ?>" class="musiSwipe--song--btn--link"><i class="fa-solid fa-heart"></i></a>
    </div>
</main>













<script>
  const la = document.getElementById("la");
  const le = document.getElementById("le");

  const form = document.getElementById("saveLiked");
  const formLiked = document.getElementById("liked");
  const formDisliked = document.getElementById("disliked");
  let isFormSubmitted = false;

  function startDrag(e) {
    if (isFormSubmitted) return;
    this.ontouchmove = this.onmspointermove = moveDrag;

    this.ontouchend = this.onmspointerup = function () {
      this.ontouchmove = this.onmspointermove = null;
      this.ontouchend = this.onmspointerup = null;
    }

    var pos = [this.offsetLeft, this.offsetTop];
    var that = this;
    var origin = getCoors(e);

    function moveDrag(e) {
      var currentPos = getCoors(e);
      var leftInitial = this.style.left;
      // la.value = leftInitial;
      var deltaX = currentPos[0] - origin[0];
      this.style.left = (pos[0] + deltaX) + 'px';
      var deltaXString = deltaX.toString();
      
      if (pos[0] + deltaX <= 75) {
        // le.value = "Pas aimé";
        formDisliked.value = "<?= $id ?>";
        form.submit();
        isFormSubmitted = true;
      } else if (pos[0] + deltaX >= 250) {
        
        // le.value = "Aimé";
        formLiked.value = "<?= $id ?>";
        form.submit();
        isFormSubmitted = true;
      } 
      return false; // cancels scrolling
    }
  }

  function getCoors(e) {
    var coors = [];
    if (e.targetTouches && e.targetTouches.length) {
      var thisTouch = e.targetTouches[0];
      coors[0] = thisTouch.clientX;
      coors[1] = thisTouch.clientY;
    } else {
      coors[0] = e.clientX;
      coors[1] = e.clientY;
    }
    // console.log("Coors 2 " + coors);
    return coors;
  }


  const element = document.querySelector('.musiSwipe--song--detail--img');
  element.ontouchstart = element.onmspointerdown = startDrag;

  var rect = element.getBoundingClientRect();
  console.log("Initial coordinates: ", rect.left, rect.top);
  document.ongesturechange = function () {
    return false;
  }
</script>

<?= foot(); ?>