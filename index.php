<?php
if (session_id() == "") {
    session_start();
}
?>

<?php include('./helpers/debug.php'); ?>
<?php include('./helpers/config.php'); ?>
<?php include('./helpers/time_ago.php') ?>

<?php $title = 'HJEM'; ?>
<?php $currentPage = 'HJEM'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<body>

    <?php echo '<div id="message-container"></div>'; ?>

    <!-- TODO: Sliding gallery image -->
    <!-- <img id="landing-image" class="img-fluid" src="./media/landing.png" style="margin-bottom: 15px;"> -->

    <img id="landing-image" src="./media/webres/tresfjord_brua.png">

    <script type="text/javascript">
        var loggedin = '<?php if (isset($_SESSION['loggedin'])) { echo $_SESSION['loggedin'];} else {echo 0;} ?>';
        var a = '<?php if (isset($_SESSION['formann'])) {echo $_SESSION['formann'];} else {echo 0;} ?>';
    </script>

    <?php
    # include the javascript only if user is logged in and labeled administrator
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1) && isset($_SESSION['formann'])) {
        echo '<script type="text/javascript" src="./js/modal-news.js"></script>';
        echo '<script type="text/javascript">';
        echo '$(document).ready(function() {';
        echo 'document.getElementById("tutorial-post").style.display = "block";';
        echo '});';
        echo '</script>';
    }
    ?>

    <div class="container" id="content">

        <?php include('./components/news.php'); ?>

        <?php include('./components/tide.php'); ?>

    </div>

    <div id="kart">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1835.4272897020628!2d7.137452816050022!3d62.61109948292489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4616ab12ed98ab27%3A0xdec8b461e7acbc20!2zVmlrZSBTbcOlYsOldGZvcmVuaW5n!5e0!3m2!1sen!2snl!4v1578869888889!5m2!1sen!2snl" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</body>

<?php include('./foot.php'); ?>

<style>

    .nav-link {
        color: white !important;
    }
    .navbar-brand i:hover {
        background-color: transparent;
    }

    /* Make nav bar opaque when mobile width viewport */
    @media only screen and (max-width: 768px) {
        #navigation-bar {
            background-color: rgb(37, 52, 104) !important;
        }

        .navbar-collapse {
            margin-bottom: 70px;
        }
    }


    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 600px) {
        body {
            padding-bottom: 420px;
        }
    }

    @media only screen and (min-width: 600px) {
        body {
            padding-bottom: 300px;
        }
    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {
        body {
            padding-bottom: 420px;
        }

    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {
        body {
            padding-bottom: 425px;
        }

    }

    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {
        body {
            padding-bottom: 435px;
        }
    }

    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {
        body {
            padding-bottom: 435px;
        }
    }
</style>