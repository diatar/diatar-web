<?php 

//forras: https://www.w3schools.com/howto/howto_js_slideshow.asp

//770x200
?>

<div class="rotator-container">

	<?php
		$flist = glob("rotatingimages/*.jpg");
		foreach($flist as $fname) {
			echo '<div class="mySlides fade">';
			echo '<img src="'.$fname.'" style="width:100%">';
			echo '</div>';
		}
	?>
</div>
<br>

<script>

var slideIndex = 0;
showSlides(slideIndex);

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  //slideIndex=rand(0,slides.length);
  setTimeout(showSlides, 5000); // Change image every 5 seconds
}

</script>

<?php

//vege

?>
