<?php
if (session_id() == "") {
	session_start();
}
?>
<?php $title = 'Logg inn'; ?>
<?php $currentPage = 'Logg in'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<body>

    <?php echo '<div id="message-container"></div>'; ?>

    <script type="text/javascript">
        var message = '<?php if (isset($_SESSION['message'])) { echo $_SESSION['message'];} else { echo "NA";} ?>';

        $(document).ready(function() {
            var message = '<?php if (isset($_SESSION['message'])) { echo $_SESSION['message'];} else { echo "";} ?>';
            if (message != "") {
                document.getElementById("message-container").appendChild(showMessage("warning", message));
                setTimeout(function() {
                    document.getElementById("message").parentNode.removeChild(document.getElementById("message"));
                }, 5000);
            }
        });
        <?php
        // remove current message
        $_SESSION['message'] = "";
        ?>

    </script>

    <div class="container login">
        <h2>Logg inn</h2>
        <hr>
        <form action="./helpers/auth.php" method="post">

            <label class="sr-only" for="username">Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control" name="username" placeholder="Brukernavn" id="username" required>
            </div>

            <label class="sr-only" for="password">Passord</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="password" class="form-control" name="password" placeholder="Passord" id="password" required>
            </div>

            <input type="submit" id="login-btn" class="btn btn-primary" value="Logg inn">

        </form>

        <div id="register-btn">
            <a href="./register.php">Ny konto</a>
        </div>        
    </div>

</body>

<style>

body {
    /* background-color: rgba(57, 82, 170, 1); */
    background-image: url("./media/tresfjord_brua_bw.png");
    background-size: auto 100vh;
    background-repeat: no-repeat;
}

</style>
