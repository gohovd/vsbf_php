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

    <img id="landing-image" class="img-fluid" src="./media/tresfjord_brua.png">

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

        <div class="row">
            <div class="col-xs-12 heading">
                NYTT
            </div>
        </div>


        <div class="row">
            <div id="news" class="col-sm-12">

                <div id="news-cms" style="display: none;">
                    <div class="row" id="news-advanced-functions">
                        <div class="col-sm-4 d-flex justify-content-center">
                            <button id="create-news" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Skriv nytt innlegg"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>

                        <div class="col-sm-4 d-flex justify-content-center">
                            <button id="update-news" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Endre ett innlegg"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </div>

                        <div class="col-sm-4 d-flex justify-content-center">
                            <button id="delete-news" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Slett ett eller flere innlegg"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="news-posts">

                <!-- get posts from db and display html -->
                <?php
                $query = "SELECT * FROM news ORDER BY date DESC";
                if ($result = $con->query($query)) {
                    // nothing..
                } else {
                    error_log("Error collecting news from db: " . $con->error);
                }

                while ($result_ar = mysqli_fetch_assoc($result)) {
                    echo "<div class='post' id='" . $result_ar['id'] . "'>";

                    echo "<div id='post-header' class='row post-header'>";

                    echo "<div id='title' class='col-md-12'>";
                    echo "<h4>" . $result_ar['title'] . "</h4>";
                    echo "</div>";

                    echo "</div>";

                    echo "<div id='date-row' class='row'>";
                    echo "<div class='col-md-12' id='date'><i>Skrevet av</i> " . $result_ar['author'] . " <i>den</i> " . norsk_dato(new Datetime($result_ar['date']));
                    echo "</div>";
                    echo "</div>";

                    echo "<div id='btn-row' class='post-header-btn-row'>";
                    echo "</div>";

                    echo "<hr>";

                    echo "<p id='post-content'>";
                    echo $result_ar['content'];
                    echo "</p>";

                    echo "</div>";
                }
                ?>

                <div id="tutorial-post" class="post" style="font-size: 0.9em; display: none;">

                    <div id="post-header" class="row">

                        <div id="title" class="col-md-8">
                            <h2>Oppdatering</h2>
                            <i id="date">Skrevet av Gøran den <?php echo norsk_dato(new Datetime("2020-01-13 20:02:31")) ?></i>
                        </div>

                        <div id="btn-row" class="col-xs-4">
                            <button class="btn c-btn" disabled><i class="fa fa-pencil"></i></button>
                            <button class="btn c-btn" disabled><i class="fa fa-trash"></i></button>
                        </div>

                    </div>

                    <hr>

                    <p>
                        Vike SBF har blitt oppdatert med ny funksjonalitet. Det er no mogleg å skrive innlegg som ein legg ut her på framsida.
                        Dette gjer ein ved å trykke på <button class="btn c-btn"><i class="fa fa-plus"></i></button>&nbsp;&nbsp;
                        knappen nærme toppen av sida.<br><br>
                        Følgjeleg, ynskjer ein å endre på innlegget: trykk ein gong på denne knappen nærme toppen av sida
                        <button class="btn c-btn"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;og så på tilsvarande knapp
                        <button class="btn c-btn"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp; som dukkar opp på sida av innlegget.
                        <p style="padding-left: 25px; color: gray;">
                            (I høgre hjørne av dette innlegget ser du to knappar.
                            Desse er deaktiverte, og fungerar som eksempel på kor dei ser ut.)
                        </p>

                        For å slette innlegg <button class="btn c-btn"><i class="fa fa-trash"></i></button>&nbsp;&nbsp; trykk
                        knappen med bilete av ei avfalls-bytte nærme toppen av sida. Det dukker så opp to knappar:
                        <ul id="btnlist">
                            <li><button class="btn btn-danger"><i class="fa fa-globe"></i></button>&nbsp;&nbsp;
                                kan finnast til høgre for knappen du nyst trykte. Trykk på denne knappen leier til at ein sletter
                                alle innlegg, men ikkje før ein har trykt "Ja" i ein dialog-boks som sprett opp.</li>
                            <li><button class="btn c-btn"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;
                                dukkar opp i høgre hjørne av alle innlegg, trykk på denne sletter berre eitt inlegg av gongen.
                        </ul>
                    </p>

                    <style>
                        #btnlist li {
                            margin-bottom: 5px;
                        }
                    </style>

                    <!-- <hr> -->

                    <div id="post-footer" class="row">

                    </div>

                </div>

            </div>

            <!-- display the cms functionality only if logged in -->
            <script>
                if (loggedin == true && a == true) {
                    document.getElementById("news-cms").style.display = "block";

                    document.getElementById("create-news").addEventListener("click", function() {
                        var createNewsPostModal = getNewsPostModal();
                        document.body.appendChild(createNewsPostModal);
                        $('#create-news-modal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        $('#create-news-modal').modal('show');
                        tinymce.init({
                            selector: '#content-text-area',
                            plugins: "code,pagebreak,fullpage,table,fullscreen,paste,spellchecker",
                            toolbar: 'undo redo | styleselect | bold italic |' +
                                'alignleft aligncenter alignright alignjustify |' +
                                'bullist numlist outdent indent | fullscreen',
                            height: "400"
                        });
                    });

                    document.getElementById("update-news").addEventListener("click", generatePostEditButtons);
                    document.getElementById("delete-news").addEventListener("click", generatePostDeleteButtons);

                } else {
                    document.getElementById("news-advanced-functions").style.display = "none";
                    // other initialization functions (for regular users)..
                }
            </script>

        </div>

    </div>
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

    @media only screen and (max-width: 768px) {
        #navigation-bar {
            background-color: rgb(37, 52, 104) !important;
        }

        .navbar-collapse {
            margin-bottom: 70px;
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