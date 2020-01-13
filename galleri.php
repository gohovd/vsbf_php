<?php

if (session_id() == "") {
	session_start();
}

$title = 'Galleri';
$currentPage = 'Galleri';

include("./head.php");
include('./nav-bar.php');
?>

<body>

	<div id="slideshowHolder" class="container"></div>

	</div>

	<script>
		const DIR = './media/foer/';
		const IMAGE_NAME = 'foer';
		const FILE_EXTENSION = '.jpg';
		const IMAGE_COUNT = 22;

		const captions = [{
			"id": "1",
			"text": "<i>Foto</i>: <i class='fa fa-facebook-official' aria-hidden='true'></i>&nbsp;<a href='https://www.facebook.com/molnesdronetjenester/'>Molnes Dronetjenester</a>"
		}];

		function checkImage(imageSrc, good, bad) {
			var img = new Image();
			img.onload = good;
			img.onerror = bad;
			img.src = imageSrc;
		}

		for (var i = 1; i <= IMAGE_COUNT; i++) { // increase or decrease i as you add or remove images from foer folder
			var image_path = DIR + IMAGE_NAME + i + FILE_EXTENSION;
			
			var imgDiv = document.createElement('div'); // div container for img
			var img = document.createElement('img'); // img

			img.src = DIR + IMAGE_NAME + i + FILE_EXTENSION; // graphics/foer/[number].jpg
			img.className = 'img-fluid'; // add classes to the img element

			imgDiv.id = 'imgDiv' + i; // give the img container an id (div)
			imgDiv.className = 'imgDiv'; // add classes to the div element

			var caption = document.createElement('div');
			caption.id = 'caption' + i;
			caption.className = 'caption';

			document.getElementById('slideshowHolder').appendChild(imgDiv); // add the container to the slideshow holder
			document.getElementById('imgDiv' + i).appendChild(img); // add the image to its container
			document.getElementById('imgDiv' + i).appendChild(caption);
		}

		// Attach all the captions to their imgDivs
		for (i in captions) {
			var id = captions[i].id;
			var c = document.getElementById('caption' + id);
			c.innerHTML = captions[i].text;
		}
	</script>

	<button class="btn btn-secondary float-left" onclick="plusDivs(-1)">&#10094;</button>
	<button class="btn btn-secondary float-right" onclick="plusDivs(1)">&#10095;</button>

	</div>

	<script>
		var slideIndex = 1; // initial index (i.e. foer/1 is first image to be shown)

		showDivs(slideIndex);

		function plusDivs(n) {
			showDivs(slideIndex += n);
		}

		function showDivs(n) {
			var i;
			var x = document.getElementsByClassName("imgDiv");
			if (n > x.length) {
				slideIndex = 1
			} // if the slideIndex goes over max images, rollover to 1
			if (n < 1) {
				slideIndex = x.length
			}
			for (i = 0; i < x.length; i++) { // hide all images
				x[i].style.display = "none";
			}
			x[slideIndex - 1].style.display = "block"; // ... except one
		}
	</script>

</body>

<?php
include('./foot.php');
?>