<?php
    session_start();

    if (!$_SESSION["event_id"]) {
        // User logged in, redirect to homepage
        Header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>AAIV Attendance</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/source.js"></script>
		<script>
		$(document).ready(function (){
			displayEventTracking();
			$(".close").on("click", function(e) {
				e.preventDefault();
				$(".alert").removeClass("in");
			});

			$("#submitAttendance").on("click", function(e) {
				submitForm();
			});

			$("#closeTracking").on("click", function(e) {
				e.preventDefault();
				closeEventTracking();
			});
		});
		</script>
	</head>
	<body>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-3">
				<div id="currentTrack" class="alert alert-info"><a id="closeTracking" href="#" class="alert-link">Log out</a></div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-lg-offset-3">
				<h1 class="attendance-header">Welcome to Focus!</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-lg-offset-3">
				<div id="confirmation" class="confirmation-image" style="display: none;">
					<img src="img/checkmark.png">
				</div>
				<div id="loginForm" class="container verticalSpace3">
					<input type="text" class="hidden event_id" id="28">
					<form class="form-horizontal">
						<div id="firstName" class="form-group">
							<div class="col-lg-10 col-lg-offset-0">
								<input type="text" class="form-control welcome-inputs" id="firstname" placeholder="first name..">	
							</div>
						</div>
						<div id="lastName" class="form-group">
							<div class="col-lg-10 col-lg-offset-0">
								<input type="text" class="form-control welcome-inputs" id="lastname" placeholder="last name..">
							</div>
						</div>
						<div id="Email" class="form-group">
							<div class="col-lg-10 col-lg-offset-0">
								<input type="text" class="form-control welcome-inputs" id="email" placeholder="email..">
							</div>
						</div>
						<div id="Dorm" class="form-group">
							<div class="col-lg-10">
								<input type="text" class="form-control welcome-inputs" id="dorm" placeholder="dorm..">
							</div>
						</div>
						<div id="Year" class="form-group">
							<div class="col-lg-10">
								<select id="yearSelect" class="form-control welcome-inputs">
									<option value="..">choose year..</option>
									<option value="freshman">freshman</option>
									<option value="sophomore">sophomore</option>
									<option value="junior">junior</option>
									<option value="senior">senior</option>
									<option value="other">other</option>
								</select>
							</div>
						</div>
						<div id="Submit" class="form-group">
							<div class="col-lg-10">
								  <button id="submitAttendance" type="button" class="btn btn-primary btn-block submit-button">Submit</button>
							</div>
						</div>
					</form>	
				</div>
			</div>
			<div class="col-lg-5 verticalSpace3">
				<ul class="list-group">
					<li id="1" class="list-group-item"><strong>Phil House </strong><span class="pull-right"><strong>philiphouse2015@u.northwestern.edu</strong><span></li>
					<li id="2" class="list-group-item"><strong>Philip House </strong><span class="pull-right"><strong>philiphouse2015@u.northwestern.edu</strong><span></li>
					<li id="3" class="list-group-item"><strong>er House </strong><span class="pull-right"><strong>philiphouse2015@u.northwestern.edu</strong><span></li>
					<li id="4" class="list-group-item"><strong>Phil House </strong><span class="pull-right"><strong>philiphouse2015@u.northwestern.edu</strong><span></li>
					<li id="5" class="list-group-item"><strong>Phil House </strong><span class="pull-right"><strong>philiphouse2015@u.northwestern.edu</strong><span></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="verticalSpace fade alert alert-danger alert-dismissable">
					<button type="button" class="close" aria-hidden="true">&times;</button>
					<strong>Worrd</strong>
				</div>
			</div>
		</div>


	</body>
</html>
