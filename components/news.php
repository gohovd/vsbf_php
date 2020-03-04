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