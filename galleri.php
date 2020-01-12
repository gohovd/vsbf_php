<?php

if (session_id() == "") {
	session_start();
}

include("./head.php");
include('./nav-bar.php');

$title = 'Galleri';
$currentPage = 'Galleri';

echo '<div class="under-construction">
<p>
Under konstruksjon
</p>
<a href="'.$baseUrl.'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
</div>';

echo '<style>';
echo 'body { background-color: rgba(68, 85, 140, 0.8); }';
echo '</style>';

include('./foot.php');