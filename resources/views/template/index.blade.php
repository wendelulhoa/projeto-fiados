<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta content="Um site de diversos mods, GTA V, GTA SAN ANDREAS, EURO TRUCK SIMULATOR 2, MODELOS 3D, GTA IV" name="description">
		<meta content="Ulhoa developers" name="author">
		<meta name="keywords" content="mods br, mods ets2, mods gta5, mods gta sa, mods 3d"/>


		<!-- Title -->
		<link rel="sortcut icon" href="{{ mix('images/logo.png') }}" type="image/x-icon" />
		<title>Blog</title>

		<!--Bootstrap css-->
		<link rel="stylesheet" href="{{ mix('/plugins/bootstrap/css/bootstrap.min.css') }}">

		<!--Style css -->
		<link href="{{ mix('/css/style.css') }}" rel="stylesheet" />
		<link href="{{ mix('/css/dark-style.css') }}" rel="stylesheet" />
		<link href="{{ mix('/css/skin-modes.css') }}" rel="stylesheet">
		<link href="{{ mix('/css/icons.css') }}" rel="stylesheet">

		<!-- P-scrollbar css-->
		<link href="{{ mix('/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link href="{{ mix('/plugins/sidemenu/sidemenu.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />

		<!-- Rightsidebar css -->
		<link href="{{ mix('/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css"> --}}
		<style>
			
			#global-loader img {
				position: inherit !important;
			}
			.global-hide{
				display: none;
			}
			.global-see{
				display: block !important;
			}
			.app-header, .app-sidebar{
				opacity: 0.9;
			}

			.app-sidebar{
				top: -1px !important;
			}
		</style>
		@yield('script-css')
	</head>

	<body class="app sidebar-mini rtl">
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
						
						</div>


						@if (Route::current()->getName() != 'index' && Route::getCurrentRoute()->getName() != 'mods-edit')
							<div class="tags ml-5 mb-5 pb-5">
								@if (isset($keyCategories))
									@foreach ($keyCategories as $item)
										<a href="{{ Route('search-category-'.$routesNames[$game].'-and-tag', ['category'=> $categoriesModsEn[$item]]) }}" class="badge badge-default mr-1 mt-2" style="background: #808080"><i class="fas fa-tag"></i> {{ $categoryMod[$item] }}</a>
									@endforeach
								@elseif(isset($tags))
									@foreach ($tags as $key => $item)
										@if (isset($tagSelected) && $tagSelected == $tagEn[$key])
											<a href="{{ Route('search-category-'.$routesNames[$game].'-and-tag', ['category'=> $categoriesModsEn[$category], 'tag'=> $tagEn[$key] ]) }}" class="badge badge-default mr-1 mt-2" ><i class="fas fa-check"></i> {{ $item }}</a>
										@else
											<a href="{{ Route('search-category-'.$routesNames[$game].'-and-tag', ['category'=> $categoriesModsEn[$category], 'tag'=> $tagEn[$key] ]) }}" class="badge badge-default mr-1 mt-2" style="background: #808080"><i class="fas fa-tag"></i> {{ $item }}</a>
										@endif
									@endforeach
								@endif
							</div>
						@endif
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
										<a class="social-icon" href="https://www.youtube.com/channel/UCidYh2oEwCPegcEvsZqhO7g"><i class="fab fa-youtube"></i></a>
									</li>
									<li>
										<a class="social-icon" href=""><i class="fab fa-instagram"></i></a>
									</li>
								</ul>
							</div>
							<div class="col-lg-12 col-sm-12   text-center">
								Copyright © 2021 <a href="#">Ulhoa developer</a>. Designed by <a href="#">Ulhoa</a> todos os direitos reservados.
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

		<!--Side-menu js-->
		<script src="{{ mix('/plugins/sidemenu/sidemenu.js') }}"></script>


		<!-- P-scrollbar js-->
		<script src="{{ mix('/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
		<script src="{{ mix('/plugins/p-scrollbar/p-scrollbar-leftmenu.js') }}"></script>

		<!-- Rightsidebar js -->
		<script src="{{ mix('/plugins/sidebar/sidebar.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<!-- Custom js-->
		{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script> --}}
		
		<script src="{{ mix('/js/custom.js') }}"></script>
		@yield('script-js')
		@include('template.global-js')
	</body>
</html>
