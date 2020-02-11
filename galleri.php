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

	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

		<!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
		<div class="pswp__bg"></div>

		<!-- Slides wrapper with overflow:hidden. -->
		<div class="pswp__scroll-wrap">

			<!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
			<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<!--  Controls are self-explanatory. Order can be changed. -->

					<div class="pswp__counter"></div>

					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

					<button class="pswp__button pswp__button--share" title="Share"></button>

					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

					<!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
					<!-- element will get class pswp__preloader--active when preloader is running -->
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>

				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>

				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>

				<script type="text/javascript">
					var pswpElement = document.querySelectorAll('.pswp')[0];

					// build items array
					var items = [{
							src: 'media/tresfjord_brua.png',
							w: 4670,
							h: 2188
						},
						{
							src: 'media/tresfjord_fjellene.png',
							w: 4896,
							h: 1956
						}
					];

					// define options (if needed)
					var options = {
						// optionName: 'option value'
						// for example:
						index: 0 // start at first slide
					};

					// Initializes and opens PhotoSwipe
					var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
					gallery.init();
				</script>

			</div>

		</div>

	</div>

	<!-- <div id="slideshowHolder" class="container"></div>

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
	</script> -->

</body>

<?php
include('./foot.php');
?>