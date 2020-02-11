<?php
if (session_id() == "") {
	session_start();
}
?>
<?php $title = 'Kontakt'; ?>
<?php $currentPage = 'Kontakt'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<body>

	<div class="container contacts" style="margin-top: 25px;">

		<div class="row">

			<div class="col-md-4">
				<div class="card">
					<div class="card-header" style="color: black;">
						<i class="fa fa-envelope" style="color: rgb(68, 85, 140); font-size: 1.3em;"></i>&nbsp;&nbsp;<i>Brevpost sendes til</i>
					</div>
					<div class="card-body">
						<h5 class="card-title" style="color: black;">Addresse</h5>
						<p class="card-text">
							Vike Småbåtforening ved Bjørn Ove Ulla<br>
							Heen-feltet<br>
							6392 Vikebukt</p>
					</div>
				</div>
			</div>


			<style>
				table th {
					color: black;
				}
			</style>
			<div class="col-md-8 table-responsive">
				<table class="table">
					<tr>
						<th></th>
						<th>Navn</th>
						<th>Epost</th>
						<th>Telefon<br></th>
					</tr>
					<tr>
						<td>Formann</td>
						<td>Bjørn Ove Ulla<br></td>
						<td>bjorn.ulla (at) timpex.no</td>
						<td>924 34 571<br></td>
					</tr>
					<tr>
						<td>Nest formann<br></td>
						<td>Ola Vik<br></td>
						<td>ola.vik (at) nasta.no<br></td>
						<td>977 53 093<br></td>
					</tr>
					<tr>
						<td>Kasserer</td>
						<td>Sveinung Dragnes<br></td>
						<td>sveinung.dragnes (at) online.no</td>
						<td>938 44 396<br></td>
					</tr>
					<tr>
						<td>Referent</td>
						<td>Jan Olav Forland<br></td>
						<td>jan.olav.forland (at) mibox.no</td>
						<td>903 53 720<br></td>
					</tr>
					<tr>
						<td>Styremedlem</td>
						<td>Odd Johnny Villa<br></td>
						<td>oj.villa (at) hotmail.com</td>
						<td>917 80 424<br></td>
					</tr>
				</table>
			</div>

		</div>

		<div class="row" id="contact-form">
			<div class="col-lg-12">
				
			</div>
		</div>
	</div>
</body>

<?php
include('./foot.php');
?>