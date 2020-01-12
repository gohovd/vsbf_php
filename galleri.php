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
	<div class="under-construction">
		<p>Under konstruksjon</p>
		<a href="<?php echo $baseUrl ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
	</div>
</body>

<style>
	body {
		background-color: rgba(68, 85, 140, 0.8);
	}
</style>

<?php
	include('./foot.php');
?>