<?php
if (session_id() == "") {
	session_start();
}

?>
<?php $title = 'Register'; ?>
<?php $currentPage = 'Register'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body>

	<div class="container register">
	<h2>Lag ny konto</h2>
	<hr>
		<form action="./helpers/reg.php" method="post" autocomplete="off">

			<label class="sr-only" for="username">Username</label>
			<div class="input-group mb-2 mr-sm-2">
				<input type="text" class="form-control" name="username" placeholder="Brukernavn" id="username" required>
			</div>

			<label class="sr-only" for="password">Passord</label>
			<div class="input-group mb-2 mr-sm-2">
				<input type="password" class="form-control" name="password" placeholder="Passord" id="password" required>
			</div>

			<label class="sr-only" for="email">Epost</label>
			<div class="input-group mb-2 mr-sm-2">
				<input type="text" class="form-control" name="email" placeholder="Epost" id="email" required>
			</div>
			
			<!-- <div class="g-recaptcha" data-sitekey="6LctktAUAAAAABFFRsJT50kpRkJD_37bhZ_PsAbs"></div>
			<br> -->
			<!--
				TODO: 	1. reCaptcha back end integration
						2. Form validation
						3. Show message if user exists, redirect to register with message.
			-->

			<input type="submit" class="btn btn-primary" id="reg-btn" value="Registrer">

		</form>

	</div>
</body>

<style>

body {
    /* background-color: rgba(57, 82, 170, 1); */
    background-image: url("./media/tresfjord_fjellene.png");
    background-size: auto 100vh;
    background-repeat: no-repeat;
}

</style>