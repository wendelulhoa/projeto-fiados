<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="Ulhoa mods" name="description">
		<meta content="Ulhoa developers" name="author">
		<meta name="keywords" content="mods br, mods ets2, mods gta5, mods gta sa, mods 3d"/>

		<!-- Favicon -->
		<link rel="icon" href="../../assets/images/brand/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

		<!-- Title -->
		<title>Ulhoa mods</title>

		<!--Bootstrap css-->
		<link rel="stylesheet" href="{{ mix('/plugins/bootstrap/css/bootstrap.min.css') }}">

		<!--Style css -->
		<link href="{{ mix('/css/style.css') }}" rel="stylesheet" />
		<link href="{{ mix('/css/dark-style.css') }}" rel="stylesheet" />
		<link href="{{ mix('/css/skin-modes.css') }}" rel="stylesheet">

		<!-- P-scrollbar css-->
		<link href="{{ mix('/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link href="{{ mix('/plugins/sidemenu/sidemenu.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
		<!--Daterangepicker css-->
		<link href="{{ mix('/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />

		<!-- Rightsidebar css -->
		<link href="{{ mix('/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

	</head>

	<body class="app sidebar-mini rtl">

		<!--Global-Loader-->
		<div id="global-loader">
			<img src="{{ mix('/images/loader.svg') }}" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">
					{{-- header menu --}}
				@include('template.header-menu')
				
				@include('template.sidebar-menu')

				

                <!-- app-content-->
				<div class="app-content toggle-content">
					<div class="side-app">

					    <!-- page-header -->
						<div class="page-header">
							<h1 class="page-title">Mods</h1>
							<div class="ml-auto">
								<div class="input-group">
									
									<a href="#" class=" mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="GTA 5">
										<img src="{{ mix('/images/gta5.png') }}" class="rounded-circle user_img" style="width: 60px; height: 60px;" >
									</a>
									<a href="#" class=" mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="EURO TRUCK SIMULATOR 2">
										<img src="{{ mix('/images/ets2.png') }}" class="rounded-circle user_img" style="width: 60px; height: 60px;" >
									</a>
									<a href="#" class=" mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="GTA SA">
										<img src="{{ mix('/images/gtasa.png') }}" class="rounded-circle user_img" style="width: 60px; height: 60px;" >
									</a>
									<a href="#" class=" mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="GTA 4">
										<img src="{{ mix('/images/gta4.ico') }}" class="rounded-circle user_img" style="width: 60px; height: 60px;" >
									</a>
									<a href="#" class=" mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Modelos 3d">
										<img src="{{ mix('/images/model-3d.png') }}" class="rounded-circle user_img" style="width: 60px; height: 60px;" >
									</a>
								</div>
							</div>
						</div>
						<!-- End page-header -->

						@yield('content')
					</div>

					<!-- Right-sidebar-->
					@include('template.right-sidebar')

				</div>
				<!-- End app-content-->

				<!--Footer-->
				<footer class="footer side-footer">
					<div class="container">
						<div class="row align-items-center">
							<div class="social">
								<ul class="text-center">
									<li>
										<a class="social-icon" href=""><i class="fab fa-facebook-square"></i></a>
									</li>
									<li>
										<a class="social-icon" href=""><i class="fa fa-rss"></i></a>
									</li>
									<li>
										<a class="social-icon" href=""><i class="fab fa-youtube"></i></a>
									</li>
									<li>
										<a class="social-icon" href=""><i class="fab fa-instagram"></i></a>
									</li>
								</ul>
							</div>
							<div class="col-lg-12 col-sm-12   text-center">
								Copyright © 2021 <a href="#">Ulhoa developer</a>. Designed by <a href="https://www.spruko.com/">Ulhoa</a> todos os direitos reservados.
							</div>
						</div>
					</div>
				</footer>
				<!-- End Footer-->

			</div>
		</div>
		<!-- End Page -->

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- Jquery js-->
		<script src="{{ mix('/js/jquery-3.4.1.min.js') }}"></script>

		<!--Bootstrap.min js-->
		<script src="{{ mix('/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ mix('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!--Jquery Sparkline js-->
		<script src="{{ mix('/js/jquery.sparkline.min.js') }}"></script>

		<!-- Chart Circle js-->
		<script src="{{ mix('/js/circle-progress.min.js') }}"></script>

		<!-- Star Rating js-->
		<script src="{{ mix('/plugins/rating/jquery.rating-stars.js') }}"></script>

		<!--Moment js-->
		<script src="{{ mix('/plugins/moment/moment.min.js') }}"></script>

		<!-- Daterangepicker js-->
		<script src="{{ mix('/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

		<!--Side-menu js-->
		<script src="{{ mix('/plugins/sidemenu/sidemenu.js') }}"></script>

		<!--Time Counter js-->
		<script src="{{ mix('/plugins/counters/jquery.missofis-countdown.js') }}"></script>
		<script src="{{ mix('/plugins/counters/counter.js') }}"></script>

		<!-- P-scrollbar js-->
		<script src="{{ mix('/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
		<script src="{{ mix('/plugins/p-scrollbar/p-scrollbar-leftmenu.js') }}"></script>

		<!-- Rightsidebar js -->
		<script src="{{ mix('/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Custom js-->
		<script src="{{ mix('/js/custom.js') }}"></script>
		@include('template.template-js')
		@yield('script-js')

	</body>
</html>