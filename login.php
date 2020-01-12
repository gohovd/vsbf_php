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

    <div class="login card">
        <h1>Login</h1>
        <form action="./helpers/auth.php" method="post">
            <label for="username">
                <i class="fa fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Brukernavn" id="username" required>
            <label for="password">
                <i class="fa fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Passord" id="password" required>
            <input type="submit" value="Login">
        </form>
        
    </div>

    <div style="text-align: center; margin-top: -90px;">
        Ingen konto? <a href="./register.php">Registrer deg</a>.
    </div>

</body>