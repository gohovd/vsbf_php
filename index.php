<?php
if (session_id() == "") {
    session_start();
}
?>

<?php include('./helpers/debug.php'); ?>
<?php include('./helpers/config.php'); ?>
<?php include('./helpers/create_db.php'); ?>

<?php $title = 'Home'; ?>
<?php $currentPage = 'Home'; ?>

<?php include('head.php'); ?>
<?php include('nav-bar.php'); ?>

<body>
    <!-- TODO: Sliding gallery image -->
    <img id="landing-image" class="img-fluid" src="./media/landing.png" style="margin-bottom: 15px;">

    <script type="text/javascript">
        var loggedin = '<?php if (isset($_SESSION['loggedin'])) { echo $_SESSION['loggedin'];} else { echo 0;} ?>';
        var message = '<?php if (isset($_SESSION['message'])) { echo $_SESSION['message'];} else { echo "NA";} ?>';
        console.log("Message: "+message);
    </script>

    <?php
    # include the javascript only if user is logged in and labeled administrator
        if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
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
                    $(function () {
                        // initi tooltips around the globe
                        $('[data-toggle="tooltip"]').tooltip()
                    })
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
                                    echo "<div id='author' class='col-md-6'>";
                                        echo "Skrevet av: " . $result_ar['author'];
                                    echo "</div>";
                                    echo "<div id='updated-date' class='col-md-3'>";
                                    if ($result_ar['updated'] != null) {
                                        echo "<i>Endret: " . $result_ar['updated'] . "</i>";
                                    }
                                    echo "</div>";
                                    echo "<div id='date' class='col-md-3'>";
                                        echo "<i>Dato: " . $result_ar['date'] . "</i>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>

                    <div class="post">

                        <div id="post-header" class="row">
                            <div id="title" class="col-md-8">
                                <h4>Oppdatert nettside</h4>
                            </div>
                            <div id="btn-row" class="col-xs-4">
                                <button class="btn c-btn"><i class="fa fa-envelope"></i></button>
                                <button class="btn c-btn"><i class="fa fa-globe"></i></button>
                                <button class="btn c-btn"><i class="fa fa-phone"></i></button>
                            </div>
                        </div>

                        <hr>

                        <p>
                            Vike SBF oppdatert 2020 med ny funksjonalitet.
                        </p>

                        <hr>

                        <div id="post-footer" class="row">
                            <div id="author" class="col-md-4">
                                <i>Skrevet av: Gøran</i>
                            </div>
                            <div id="updated-date" class="col-md-4">
                                <i>Endret: 2020-01-10 15:55:31</i>
                            </div>
                            <div id="date" class="col-md-4">
                                <i>Dato: 2020-01-10 15:55:31</i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- display the cms functionality only if logged in -->
                <script>
                    if (loggedin == true) {
                        document.getElementById("news-cms").style.display = "block";

                        document.getElementById("create-news").addEventListener("click", function() {
                            var createNewsPostModal = getNewsPostModal();
                            document.body.appendChild(createNewsPostModal);
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
                <h3>Informasjon</h3>
                <ul>
                    <li>Noe som skjedde</li>
                    <li>Noe annet som skjedde</li>
                </ul>
            </div>
            
        </div>
    </div>

</body>

<?php include('foot.php'); ?>