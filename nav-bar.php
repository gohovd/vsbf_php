<?php
if (session_id() == "") {
    session_start();
}
?>

<div class="container">
    <ul class="nav">

        <?php

        // Wamp add VirtualHost to get rid of this
        $baseUrl = '/php_web_project/tutorial';

        // Make a list of every possible URL for the site
        $urls = array(
            'Home' => '/',
            'Cookies' => '/cookies',
            'Login' => '/login'
        );

        $admin_urls = array(
            'CMS' => '/cms'
        );

        // generate HTML for navigation links
        // adds active class to current page
        foreach ($urls as $name => $url) {
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE && $name == 'Login') {
                // produce logout link if logged in TODO: call session_destroy() when logout button is clicked
                print '<li id="Logoutlink" class="nav-link" onclick="logout()"><a href="#">Logout</a></li>';
                continue;
            } else {
                print '<li id="' . $name . 'link" ' . (($currentPage === $name) ? ' class="nav-link active" ' : ' class="nav-link" ') .
                    '><a href="' . $baseUrl . $url . '">' . $name . '</a></li>';
            }
        }

        print '<img class="w3-hide-small" id="navIcon" src="./media/icon.png">';

        // if logged in, produce special links
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) {
            foreach ($admin_urls as $name => $url) {
                print '<li ' . (($currentPage === $name) ? ' class="nav-link active" ' : ' class="nav-link" ') .
                    '><a href="' . $baseUrl . $url . '">' . $name . '</a></li>';
            }
        }

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