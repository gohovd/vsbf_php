<?php
if (session_id() == "") {
	session_start();
}
?>
<?php $title = 'Register'; ?>
<?php $currentPage = 'Register'; ?>

<?php include('head.php'); ?>
<?php include('nav-bar.php'); ?>

<body>
	<div class="register">
		<h1>Register</h1>
		<form action="./helpers/reg.php" method="post" autocomplete="off">
			<label for="username">
				<i class="fa fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Username" id="username" required>
			<label for="password">
				<i class="fa fa-lock"></i>
			</label>
			<input type="password" name="password" placeholder="Password" id="password" required>
			<label for="email">
				<i class="fa fa-envelope"></i>
			</label>
			<input type="email" name="email" placeholder="Email" id="email" required>
			<input type="submit" value="Register">
		</form>
	</div>
</body>
