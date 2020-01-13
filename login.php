<?php
if (session_id() == "") {
	session_start();
}
?>
<?php $title = 'Login'; ?>
<?php $currentPage = 'Login'; ?>

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
        <h3>Logg inn</h3>
        <form action="./helpers/auth.php" method="post">

            <label class="sr-only" for="username">Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" name="username" placeholder="Brukernavn" id="username" required>
            </div>

            <label class="sr-only" for="password">Passord</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" name="password" placeholder="Passord" id="password" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Login">

        </form>
        
    </div>

    <div style="text-align: center;">
        Ingen konto? <a href="./register.php">Registrer deg</a>.
    </div>

</body>