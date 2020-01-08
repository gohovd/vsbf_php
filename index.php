<?php
if (session_id() == "") {
    session_start();
}
?>

<?php include('./helpers/debug.php'); ?>
<?php include('./create_db.php'); ?>

<?php $title = 'Home'; ?>
<?php $currentPage = 'Home'; ?>

<?php include('head.php'); ?>
<?php include('nav-bar.php'); ?>

<?php include('config.php'); ?>

<!-- js functions to CRUD news -->
<script type="text/javascript" src="./js/modal-news.js"></script>

<body>

    <!-- TODO: Sliding gallery image -->
    <img id="landing-image" class="img-fluid" src="./media/landing.png" style="margin-bottom: 15px;">

    <script type="text/javascript">
        var loggedin = '<?php if (isset($_SESSION['loggedin'])) { echo $_SESSION['loggedin'];} else { echo 0;} ?>';
    </script>

    <div class="container" id="content">

        <div class="row">
            <div id="news" class="col-md-8">

            <div id="news-cms">
                <div id="news-advanced-functions" style="display: none;">
                    <button id="create-news" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Skriv nytt innlegg"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    <button id="update-news" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Endre ett innlegg"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button id="delete-news" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Slett ett eller flere innlegg"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>

                <div id="news-functions">
                    <button id="expand-news" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Utvid alle innlegg"><i class="fa fa-expand" aria-hidden="true"></i></button>
                    <button id="filter-news" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Filtrer innlegg"><i class="fa fa-filter" aria-hidden="true"></i></button>
                <!--
                    Search
                    Filter
                    Order by
                    .. change sql query based on selection
                -->
                </div>
            </div>

                <script type="text/javascript">
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>

                <div id="news-posts">
                    
                    <!-- get posts from db and display html -->
                    <?php
                        $query = "SELECT * FROM news ORDER BY date DESC";
                        if ($result = $con -> query($query)) {
                            // Do nothing
                        } else {
                            echo "Error collecting news from db: " . $con->error . "<br>";
                        }

                        while ($result_ar = mysqli_fetch_assoc($result)) {
                            echo "<div class='post'>";
                                echo "<div id='post-header' class='row'>";
                                    echo "<div id='title' class='col-md-8'>";
                                        echo "<h4>" . $result_ar['title'] . "</h4>";
                                    echo "</div>";
                                    echo "<div id='date' class='col-md-4'>";
                                        echo "<h6>" . $result_ar['date'] . "</h6>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<hr>";
                                echo "<p>";
                                    echo $result_ar['content'];
                                echo "</p>";
                                echo "<hr>";
                                echo "<div id='post-footer' class='row'>";
                                    echo "<div id='author' class='col-md-8'>";
                                        echo "Skrevet av: " . $result_ar['author'];
                                    echo "</div>";
                                    echo "<div id='updated-date' class='col-md-4'>";
                                        echo "<i>" . $result_ar['updated'] . "</i>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>

                    <div class="post">

                        <div id="post-header"class="row">
                            <div id="title" class="col-md-8">
                                <h4>Oppdatert nettside</h4>
                            </div>
                            <div id="date" class="col-md-4">
                                <h6>05-01-2020</h6>
                            </div>
                        </div>

                        <hr>

                        <p>
                            Vike SBF oppdatert 2020 med ny funksjonalitet.
                        </p>

                        <hr>

                        <div id="post-footer" class="row">
                            <div id="author" class="col-md-8">
                                Skrevet av: Gøran
                            </div>
                            <div id="updated-date" class="col-md-4">
                                <i>Sist oppdatert: 05-01-2020</i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- display the cms functionality only if logged in -->
                <script>
                    if (loggedin == true) {
                        document.getElementById("news-advanced-functions").style.display = "block";
                        document.getElementById("create-news").addEventListener("click", function() {
                            var createNewsPostModal = getNewsPostModal();
                            document.body.appendChild(createNewsPostModal);
                            $('#create-news-modal').modal('show');
                        });
                        document.getElementById("update-news").addEventListener("click", function() {
                            console.log("edit");
                        });
                        document.getElementById("delete-news").addEventListener("click", function() {

                        });
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