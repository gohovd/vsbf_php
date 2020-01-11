<?php
if (session_id() == "") {
	session_start();
}
?>
<?php $title = 'Login'; ?>
<?php $currentPage = 'Login'; ?>

<?php include('head.php'); ?>
<?php include('nav-bar.php'); ?>

<body>

    <script type="text/javascript">
        var message = '<?php if (isset($_SESSION['message'])) { echo $_SESSION['message'];} else { echo "NA";} ?>';
        console.log("Message: " + message);
    </script>

    <div class="login card">
        <h1>Login</h1>
        <form action="./helpers/auth.php" method="post">
            <label for="username">
                <i class="fa fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fa fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
        
    </div>

    <div style="text-align: center; margin-top: -90px;">
        Don't have an account? <a href="./register.php">Register</a>.
    </div>

</body>