<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Prenoto Mare</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!--	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css"> -->
		<link rel="stylesheet" href="css/animate.css">

		<!--<link rel="stylesheet" href="css/owl.carousel.min.css"> 
		<link rel="stylesheet" href="css/owl.theme.default.min.css">
		<link rel="stylesheet" href="css/magnific-popup.css">

		<link rel="stylesheet" href="css/aos.css">

		<link rel="stylesheet" href="css/ionicons.min.css">

		<link rel="stylesheet" href="css/bootstrap-datepicker.css">
		<link rel="stylesheet" href="css/jquery.timepicker.css">


		<link rel="stylesheet" href="css/flaticon.css">
		<link rel="stylesheet" href="css/icomoon.css"> -->
		<link rel="stylesheet" href="css/style.css">
		<style>
			.ftco-navbar-light .navbar-nav > .nav-item > .nav-link:hover{
				color:#007bff !important;
			}
		</style>
		
		

		 
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="background-color: #212529 !important; color: aliceblue;!important">
			<div class="container" >
				<a class="navbar-brand" href="index.php">PRENOTO SPIAGGIA<span>HOME</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
				</button>

				<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	        	<li class="nav-item "><a href="concessioni.php" class="nav-link">Concessioni</a></li>
	        <!--  <li class="nav-item"><a href="contatti.html" class="nav-link">Contatti</a></li> -->

				</ul>
				</div>
			</div>
		</nav>

		<div class="hero-wrap js-fullheight" style="background-image: url('images/prova.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
					<section class="ftco-section ftco-no-pb ftco-no-pt">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="search-wrap-1 ftco-animate p-4" style="margin-top: 50px !important;">
										<form action="search.php" class="search-property-1" autocomplete="on" method= "POST">
											<div class="row">
												<div class="col-lg align-items-end">
													<div class="form-group">
														<label for="#">Stabilimento</label>
														<div class="form-field">
															<div class="icon">
																<span class="ion-ios-search"></span>
															</div>
															<input type="text" name = "stabilimento" autocomplete ="on" id = "stabilimento" class="form-control" placeholder="Chalet">
														</div>
													</div>
												</div>
												<div class="col-lg align-items-end">
													<div class="form-group">
														<label for="#">Città</label>
														<div class="form-field">
															<div class="icon">
																<span class="ion-ios-search"></span>
															</div>
															<input type="text" name = "citta" id = "citta" autocomplete ="on" class="form-control" placeholder="Città">
														</div>
													</div>
												</div>
											
												<div class="col-lg align-self-end">
													<div class="form-group">
														<div class="form-field">
														<a href="search.php" class="nav-link"></a><input type="submit" name= "Submit" value="Search" class="form-control btn btn-primary">
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	

		<script type="text/javascript"></script>
		<script src="js/jquery.min.js"></script> 
		<script src="js/jquery-migrate-3.0.1.min.js"></script> <!--
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>-->
		<script src="js/jquery.waypoints.min.js"></script>
		<script src="js/jquery.stellar.min.js"></script> 
		<script src="js/owl.carousel.min.js"></script><!--
		<script src="js/jquery.magnific-popup.min.js"></script>-->
		<script src="js/aos.js"></script>
		<script src="js/jquery.animateNumber.min.js"></script> <!--
		<script src="js/bootstrap-datepicker.js"></script>-->
		<script src="js/scrollax.min.js"></script><!--
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> 
		<script src="js/google-map.js"></script>-->
		<script src="js/main.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
 
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

		<script type="text/javascript">
			$(function() {
				$( "#stabilimento" ).autocomplete({
				source: 'searchChalet.php',
				});
			});
		</script>

		<script type="text/javascript">
			$(function() {
				$( "#citta" ).autocomplete({
				source: 'searchCity.php',
				});
			});
		</script>


	</body>
</html>