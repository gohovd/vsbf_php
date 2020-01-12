<?php
if (session_id() == "") {
    session_start();
}
?>
<?php $title = 'Cookies'; ?>
<?php $currentPage = 'Cookies'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<body>

    <div id="cookie-chooser" class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="card text-left">
                    <img class="card-img-top" src="./media/chocolate.png" alt="chocolate cookie">
                    <div class="card-body">
                        <h4 class="card-title">Chocolate</h4>
                        <div class="btn-group" data-toggle="buttons">

                            <input type="submit" class="button" name="chocolate" value="Choose chocolate" />

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-left">
                    <img class="card-img-top" src="./media/vanilla.png" alt="vanilla cookie">
                    <div class="card-body">
                        <h4 class="card-title">Vanilla</h4>

                        <input type="submit" class="button" name="vanilla" value="Choose vanilla" />

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-left">
                    <img class="card-img-top" src="./media/raspberry.png" alt="raspberry cookie">
                    <div class="card-body">
                        <h4 class="card-title">Raspberry</h4>

                        <input type="submit" class="button" name="raspberry" value="Choose raspberry" />

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="cookie-overview" class="container">
        <?php

        if (isset($_COOKIE['cookie-flavor'])) {
            print '<p id="flavor" class="badge badge-success"> Your favorite cookie is ' . $_COOKIE['cookie-flavor'] . '.</p>';
        } else {
            print '<p id="flavor" class="badge badge-info"> Choose your favorite cookie! </p>';
        }

        ?>
    </div>

</body>

<script>
    $(document).ready(function() {
        $('.button').click(function() {
            var value = $(this).val().split(' ')[1];
            $.ajax({
                url: './helpers/cookieflavor.php',
                type: 'POST',
                data: {
                    flavor: value
                }
            }).done(function(data) {
                var label = document.getElementById("flavor");
                label.innerText = "Your favorite cookie is " + value + ".";
            }).fail(function() {
                console.log("Cookie flavor failed!");
            });
        });
    });
</script>
