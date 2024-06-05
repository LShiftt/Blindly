<?php
require '../bootstrap.php';
echo head("Blindly - MusiSwipe");


function RNG()
{

}
$sql = 'SELECT * FROM `song` WHERE 1 ORDER BY id ASC'; // by random
$sth = $dbh->prepare($sql);
$dbh->prepare($sql);
$sth->execute();
$songs = $sth->fetchAll();
?>
<style>
  .test-element {
    height: 100px;
    background-color: black;
    width: 100px;
    z-index: 5;
    position: absolute;
    top: 40vh;
    left: 49vw;
    color: white;
    text-align: center;
    -ms-touch-action: none;
  }
</style>
<div class="test-element">Element</div>
<script>function startDrag(e) {

    this.ontouchmove = this.onmspointermove = moveDrag;

    this.ontouchend = this.onmspointerup = function () {
      this.ontouchmove = this.onmspointermove = null;
      this.ontouchend = this.onmspointerup = null;
    }

    var pos = [this.offsetLeft, this.offsetTop];
    var that = this;
    var origin = getCoors(e);
    console.log("Coors 1 "+getCoors(e));

    function moveDrag(e) {
      var currentPos = getCoors(e);
      var deltaX = currentPos[0] - origin[0];
      var deltaY = currentPos[1] - origin[1];
      this.style.left = (pos[0] + deltaX) + 'px';
      this.style.top = (pos[1] + deltaY) + 'px';
      return false; // cancels scrolling
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
      console.log("Coors 2 "+ coors);
      return coors;
    }
    function nextPage(e) {

    }
  }
  var elements = document.querySelectorAll('.test-element');
  [].forEach.call(elements, function (element) {
    element.ontouchstart = element.onmspointerdown = startDrag;
    // Afficher les coordonnées initiales de l'élément
    var rect = element.getBoundingClientRect();
    console.log("Initial coordinates: ", rect.left, rect.top);


  });


  document.ongesturechange = function () {
    return false;
  }
</script>
<?php

// dump($songs);


foreach ($songs as $song) {

}
;
?>
<?= foot(); ?>