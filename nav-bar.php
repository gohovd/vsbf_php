<?php
if (session_id() == "") {
    session_start();
}
// include ('./helpers/debug.php');
$resources = array(
    'HJEM' => array(
        'url' => '/index.php',
        'icon' => 'fa fa-home',
        'function' => '',
        'restricted' => false,
        'position' => 'left'
    ),
    'LOGG INN' => array(
        'url' => '/login.php',
        'icon' => 'fa fa-sign-in',
        'function' => '',
        'restricted' => false,
        'position' => 'right'
    ),
    'TIDEVANN' => array(
        'url' => '/tide.php',
        'icon' => 'fa fa-moon-o',
        'function' => '',
        'restricted' => false,
        'position' => 'left'
    ),
    // 'GALLERI' => array(
    //     'url' => '/galleri.php',
    //     'icon' => 'fa fa-picture-o',
    //     'function' => '',
    //     'restricted' => false,
    //     'position' => 'left'
    // ),
    // TODO: Aktiver galleri visning igjen
    'LOGG UT' => array(
        'url' => '/',
        'icon' => 'fa fa-sign-out',
        'function' => 'logout()',
        'restricted' => false,
        'position' => 'right'
    ),
    'KONTAKT' => array(
        'url' => '/kontakt.php',
        'icon' => 'fa fa-address-card-o',
        'function' => '',
        'restricted' => false,
        'position' => 'left'
    )
);
?>

<div class="container-fluid" id="navigation-bar">
    <div class="container">

        <nav class="navbar navbar-expand-md navbar-light">
            <!-- <i class="fa fa-anchor"></i> -->
            <a class="navbar-brand" href="/">Vike Småbåtforening</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php
                $left_links = array();
                $right_links = array();
                $keys = array_keys($resources);
                for ($i = 0; $i < count($resources); $i++) {
                    $li_opening = '<li id="' . $keys[$i] . 'link" ' . (($currentPage === $keys[$i]) ? 'class="nav-item active" ' : 'class="nav-item"');
                    $li_closing = '</li>';
                    // debug_to_console("Keys: ".$keys[$i]);

                    if ($keys[$i] == "LOGG INN" && ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE))) {
                        continue; // if logged in, do not produce login link
                    } else if ($keys[$i] == "LOGG UT" && (!isset($_SESSION['loggedin']))) {
                        continue; // if logged out, do not produce logout link
                    }

                    // only produce link to restricted resource if user is admin
                    if ($resources[$keys[$i]]['restricted'] == true) {
                        if (!isset($_SESSION['formann'])) {
                            continue;
                        }
                    }

                    foreach ($resources[$keys[$i]] as $key => $value) {

                        switch ($key) {
                            case "url":
                                // $a_href = ($keys[$i] == "Logout") ? ('<a href="#">' . $keys[$i] . '</a>') : ('<a href="' . $baseUrl . $value . '">' . $keys[$i] . '</a>');
                                $a_open = '<a class="nav-link" href="' . $baseUrl . $value . '">';
                                $a_close = '</a>';
                                break;
                            case "icon":
                                $icon = '<i class="' . $value . '"></i>&nbsp;&nbsp;'  . $keys[$i];
                                break;
                            case "function":
                                $func = ($value != "") ? ('onclick="' . $value . '">') : ">";
                                break;
                        }
                        // debug_to_console("K,V: ".$key . " : " . $value);
                    }

                    $nav_link = $li_opening . $func .  $a_open . $icon . $a_close . $li_closing;

                    if ($key == "position" && $value == "left") {
                        array_push($left_links, $nav_link);
                    } else if ($key == "position" && $value == "right") {
                        array_push($right_links, $nav_link);
                    }
                    // $nav_link = $li_opening . $func .  $a_open . $icon . $a_close . $li_closing;
                    // print $nav_link;
                }

                if (!count($left_links) == 0) {
                    print '<ul class="navbar-nav left-links">';
                    foreach ($left_links as $index => $link) {
                        print $link;
                    }
                    print '</ul>';
                }

                if (!count($right_links) == 0) {
                    print '<ul class="navbar-nav right-links">';
                    foreach ($right_links as $index => $link) {
                        print $link;
                    }
                    print '</ul>';
                }
                // print '<img class="w3-hide-small" id="navIcon" src="./media/icon.png">';
                ?>

            </div>
        </nav>
    </div>
</div>

<!-- destroy session and redirect to home -->
<script>
    function logout() {
        $.ajax({
            type: "POST",
            url: './helpers/logout.php',
            data: {
                action: 'logout'
            },
            success: function(html) {
                window.location.reload();
            }
        });
    }

    var brand = document.getElementsByClassName("navbar-brand")[0];

    window.onload = changeBrand;
    window.onresize = changeBrand;

    function changeBrand() {
        if (window.innerWidth < 768) {
            brand.innerHTML = "<i id='brand-icon' class='fa fa-anchor'></i>";
        } else {
            brand.innerHTML = "<i id='brand-icon' class='fa fa-anchor' style='color: white;'></i>";
        }
        document.getElementsByClassName("navbar-brand")[0].style.display = "block";
        document.getElementsByClassName("navbar-toggler")[0].style.opacity = "100%";
    }

    changeBrand();


    // change style of navigation button onclick (between anchor blue and lifering red)
    (function() {
        document.getElementsByClassName("navbar-toggler")[0].addEventListener("click", function(event) {

            var icon = document.getElementById("brand-icon");

            if (icon.className == "" || icon.className == "fa fa-life-ring") {
                icon.className = "fa fa-anchor";
                icon.style.backgroundColor = "rgb(111, 169, 222)";
                icon.style.color = "white";
            } else {
                icon.className = "fa fa-life-ring";
                icon.style.backgroundColor = "red";
                icon.style.color = "white";
            }

        });


    })();
</script>