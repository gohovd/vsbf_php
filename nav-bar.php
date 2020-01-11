<?php
if (session_id() == "") {
    session_start();
}

// include ('./helpers/debug.php');
?>

<div class="container-fluid" id="navigation-bar">
<div class="container">
    <ul class="nav">

        <?php

        // Wamp add VirtualHost to get rid of this
        $baseUrl = '/php_web_project/tutorial';

        // Todo: Add icons
        // Make a list of every possible URL for the site
        $urls = array(
            'Home' => '/',
            'Galleri' => '/galleri',
            'Login' => '/login'
        );

        $resources = array
        (
            'Home' => array
            (
                'url' => '/',
                'icon' => 'fa fa-home',
                'function' => '',
                'restricted' => false
            ),
            'Login' => array
            (
                'url' => '/login',
                'icon' => 'fa fa-sign-in',
                'function' => '',
                'restricted' => false
            ),
            'Galleri' => array
            (
                'url' => '/galleri',
                'icon' => 'fa fa-picture-o',
                'function' => '',
                'restricted' => false
            ),
            'Logout' => array
            (
                'url' => '/',
                'icon' => 'fa fa-sign-out',
                'function' => 'logout()',
                'restricted' => false
            )
        );

        $keys = array_keys($resources);
        for($i = 0; $i < count($resources); $i++) {
            $li_opening = '<li id="' . $keys[$i] . 'link" ' . (($currentPage === $keys[$i]) ? 'class="nav-link active" ' : 'class="nav-link"');
            $li_closing = '</li>';
            // debug_to_console("Keys: ".$keys[$i]);

            if ($keys[$i] == "Login" && ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE))) {
                continue;
            } else if ($keys[$i] == "Logout" && (!isset($_SESSION['loggedin']))) {
                continue;
            }

            if ($resources[$keys[$i]]['restricted'] == true) {
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
                    continue;
                }
                continue;
            }

            foreach($resources[$keys[$i]] as $key => $value) {

                switch ($key) {
                    case "url":
                        // $a_href = ($keys[$i] == "Logout") ? ('<a href="#">' . $keys[$i] . '</a>') : ('<a href="' . $baseUrl . $value . '">' . $keys[$i] . '</a>');
                        $a_href = '<a href="' . $baseUrl . $value . '">' . $keys[$i] . '</a>';
                    break;
                    case "icon":
                        $icon = '<i class="' . $value . '">&nbsp;</i>';
                    break;
                    case "function":
                        $func = ($value != "") ? ('onclick="' . $value . '">') : ">";
                    break;
                }
                // debug_to_console("K,V: ".$key . " : " . $value);
                
            }
            $nav_link = $li_opening . $func . $icon . $a_href . $li_closing;
            print $nav_link;

        }
        print '<img class="w3-hide-small" id="navIcon" src="./media/icon.png">';
        ?>

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
                        window.location.replace(<?php echo "'" . $baseUrl . $urls['Home'] . "'" ?>);
                    }

                });
            }
        </script>



    </ul>
</div>
</div>