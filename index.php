<?php
if (session_id() == "") {
    session_start();
}
?>

<?php include('./helpers/debug.php'); ?>
<?php include('./helpers/config.php'); ?>

<?php $title = 'Hjem'; ?>
<?php $currentPage = 'Hjem'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<body>

    <?php echo '<div id="message-container"></div>'; ?>

    <!-- TODO: Sliding gallery image -->
    <img id="landing-image" class="img-fluid" src="./media/landing.png" style="margin-bottom: 15px;">

    <script type="text/javascript">
        var loggedin = '<?php if (isset($_SESSION['loggedin'])) { echo $_SESSION['loggedin'];} else { echo 0;} ?>';
        var a = '<?php if (isset($_SESSION['formann'])) { echo $_SESSION['formann'];} else { echo 0;} ?>';
    </script>

    <?php
    # include the javascript only if user is logged in and labeled administrator
        if ( isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1) && isset($_SESSION['formann'])) {
            echo '<script type="text/javascript" src="./js/modal-news.js"></script>';
        }
    ?>

    <div class="container" id="content">

        <div class="row">
            <div id="news" class="col-md-8">

            <div id="news-cms" style="display: none;">
                <div id="news-advanced-functions"">
                    <button id="create-news" class="btn c-btn" data-toggle="tooltip" data-placement="bottom" title="Skriv nytt innlegg"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    <button id="update-news" class="btn c-btn" data-toggle="tooltip" data-placement="bottom" title="Endre ett innlegg"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button id="delete-news" class="btn c-btn" data-toggle="tooltip" data-placement="bottom" title="Slett ett eller flere innlegg"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>

                <!-- <div id="news-functions"> -->
                    <!-- <button id="expand-news" class="btn c-btn" data-toggle="tooltip" data-placement="top" title="Utvid alle innlegg"><i class="fa fa-expand" aria-hidden="true"></i></button>
                    <button id="filter-news" class="btn c-btn" data-toggle="tooltip" data-placement="top" title="Filtrer innlegg"><i class="fa fa-filter" aria-hidden="true"></i></button> -->
                <!--
                    Search
                    Filter
                    Order by
                    .. change sql query based on selection
                -->
                <!-- </div> -->
            </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        var message = '<?php if (isset($_SESSION['message'])) { echo $_SESSION['message'];} else { echo "";} ?>';
                        if (message != "") {
                            document.getElementById("message-container").appendChild(showMessage("success", message));
                            setTimeout(function() {
                                document.getElementById("message").parentNode.removeChild(document.getElementById("message"));
                            }, 5000);
                        }
                        <?php
                        // remove current message
                        $_SESSION['message'] = "";
                        ?>

                        // init tooltips around the globe
                        $('[data-toggle="tooltip"]').tooltip()

                        // deactivate edit and delete btns if no posts to edit or delete
                        if (document.getElementsByClassName("post").length < 2) {
                            document.getElementById("update-news").disabled = true;
                            document.getElementById("delete-news").disabled = true;
                        } else {
                            document.getElementById("update-news").disabled = false;
                            document.getElementById("delete-news").disabled = false;
                        }

                    });
                </script>

                <div id="news-posts">
                    
                    <!-- get posts from db and display html -->
                    <?php
                        $query = "SELECT * FROM news ORDER BY date DESC";
                        if ($result = $con -> query($query)) {
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
                                    echo "<div id='btn-row' class='post-header-btn-row'>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<hr>";
                                echo "<p id='post-content'>";
                                    echo $result_ar['content'];
                                echo "</p>";
                                echo "<hr>";
                                echo "<div id='post-footer' class='row'>";
                                    echo "<div id='author' class='col-md-4'>";
                                        echo "<i>Skrevet av: " . $result_ar['author'] . "</i>";
                                    echo "</div>";
                                    echo "<div id='updated-date' class='col-md-4'>";
                                    if ($result_ar['updated'] != null) {
                                        echo "<i>Endret: " . $result_ar['updated'] . "</i>";
                                    }
                                    echo "</div>";
                                    echo "<div id='date' class='col-md-4'>";
                                        echo "<i>Dato: " . $result_ar['date'] . "</i>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>

                    <div class="post"  style="font-size: 0.9em;">

                        <div id="post-header" class="row">
                            <div id="title" class="col-md-8">
                                <h4>Oppdatering</h4>
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

                        <hr>

                        <div id="post-footer" class="row">

                            <div id="author" class="col-md-4">
                                
                            </div>
                            <div id="updated-date" class="col-md-4">
                                
                            </div>
                            <div id="date" class="col-md-4">
                                <i>Dato: 2020-01-10</i>
                            </div>
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
                            $('#create-news-modal').modal({backdrop: 'static', keyboard: false});
                            $('#create-news-modal').modal('show');
                            tinymce.init({selector:'#content-text-area'});
                        });

                        document.getElementById("update-news").addEventListener("click", generatePostEditButtons);
                        document.getElementById("delete-news").addEventListener("click", generatePostDeleteButtons);


                    } else {
                        document.getElementById("news-advanced-functions").style.display = "none";
                    }
                    
                </script>

            </div>

            <div id="sidebar" class="col-md-4">
                <h3>Kontakt</h3>
                    <div class="contact-detail-text">
                        <i class="fa fa-home"></i>&nbsp;&nbsp;Møre og Romsdal, 6392 Vikebukt</div>
                    <div class="contact-detail-text">
                        <i class="fa fa-envelope"></i>&nbsp;&nbsp;kasserer@vikesbf.no</div>
                    <div class="contact-detail-text">
                        <i class="fa fa-phone"></i>&nbsp;&nbsp;(+47) 924 34 571</div>
                    <div class="contact-detail-text">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp;
                        <a href="https://www.facebook.com/groups/81632657018/">Facebook gruppe</a></div><br>
                    
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1835.4272897020628!2d7.137452816050022!3d62.61109948292489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4616ab12ed98ab27%3A0xdec8b461e7acbc20!2zVmlrZSBTbcOlYsOldGZvcmVuaW5n!5e0!3m2!1sen!2snl!4v1578869888889!5m2!1sen!2snl"
                    width="100%" height="320" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>

        </div>
    </div>

</body>

<?php include('./foot.php'); ?>