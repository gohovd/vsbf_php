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

    <div class="login card">
        <h1>Login</h1>
        <form action="auth.php" method="post">
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

</body> 

<?php include('foot.php'); ?>