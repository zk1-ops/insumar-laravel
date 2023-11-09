<!DOCTYPE html>
	<html lang="en">
	<head>
	  <meta charset="utf-8"/>
	  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <meta name="description" content=""/>
	  <meta name="author" content=""/>
	  <title>{{ env('APP_NAME') }} - Administrador Insumar</title>
	   <!-- loader-->
		<!-- Bootstrap core CSS -->
		<link href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}" rel="stylesheet"/>

		<!-- simplebar CSS -->
		<link href="{{ asset('assets/dashboard/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>

		<!-- animate CSS -->
		<link href="{{ asset('assets/dashboard/css/animate.css') }}" rel="stylesheet" type="text/css"/>

		<!-- Icons CSS -->
		<link href="{{ asset('assets/dashboard/css/icons.css') }}" rel="stylesheet" type="text/css"/>

		<!-- Sidebar CSS -->
		<link href="{{ asset('assets/dashboard/css/sidebar-menu.css') }}" rel="stylesheet"/>

		<!-- Custom Style -->
		<link href="{{ asset('assets/dashboard/css/app-style.css') }}" rel="stylesheet"/>

	  
	</head>
	
	<body class="bg-theme bg-theme11">
	
	<!-- start loader -->
	   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
	   <!-- end loader -->
	
	<!-- Start wrapper-->
	 <div id="wrapper">
	
	 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
		<div class="card card-authentication1 mx-auto my-5">
			<div class="card-body">
			 <div class="card-content p-2">
				 <div class="text-center">
					 <img src="{{ asset('assets/dashboard/images/logo-icon.png') }}" alt="logo icon">
				 </div>
			  <div class="card-title text-uppercase text-center py-3">Administra Insumar, Ingresa tus credenciales: </div>
				<form method="POST" action="{{ route('auth') }}" onsubmit="return validar()">
					@csrf
				  <div class="form-group">
				  <label for="email" class="sr-only">Correo Electronico</label>
				   <div class="position-relative has-icon-right">
					  <input type="text" id="email" name="email" class="form-control input-shadow" placeholder="ejemplo@insumar.cl">
					  <div class="form-control-position">
						  <i class="icon-user"></i>
					  </div>
					  <p class="mt-1 text-danger" id="error_mail"></p>
					  @if (Session::has('email_message'))
					  	<div class="is-invalid mt-1 ml-2">
							<p class="text-danger">{{ Session::get('email_message') }}</p>
						</div>
				  	  @endif
				   </div>
				  </div>
				  <div class="form-group">
				  <label for="password" class="sr-only">Contraseña</label>
				   <div class="position-relative has-icon-right">
					  <input type="password" id="password" name="password" class="form-control input-shadow" placeholder="******">
					  <div class="form-control-position">
						  <i class="icon-lock"></i>
					  </div>
					  <p class="mt-1 text-danger" id="error_password"></p>
					  @if (Session::has('password_message'))
					  <div class="is-invalid mt-1 ml-2">
						<p class="text-danger">{{ Session::get('password_message') }}</p>
					</div>
					@endif
				   </div>
				  </div>
				 	<input type="submit" class="btn btn-light btn-block" value="Iniciar Sesion"/>
				 </form>
			   </div>
			  </div>
			  <div class="card-footer text-center py-3">
				<p class="text-warning mb-0">Visitar pagina principal? <a href="/#inicio"> Click aquí</a></p>
			  </div>
			 </div>
		
		 <!--Start Back To Top Button-->
		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		<!--End Back To Top Button-->
			
		</div><!--wrapper-->
		
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>


<!-- Validacion -->

<script src="{{ asset('assets/js/validation.js') }}"></script>

<!-- simplebar js -->
<script src="{{ asset('assets/dashboard/plugins/simplebar/js/simplebar.js') }}"></script>

<!-- sidebar-menu js -->
<script src="{{ asset('assets/dashboard/js/sidebar-menu.js') }}"></script>

<!-- loader scripts -->
<script src="{{ asset('assets/dashboard/js/jquery.loading-indicator.js') }}"></script>

<!-- Custom scripts -->
<script src="{{ asset('assets/dashboard/js/app-script.js') }}"></script>

<!-- Chart.js -->
<script src="{{ asset('assets/dashboard/plugins/Chart.js/Chart.min.js') }}"></script>

<!-- Index.js -->
<script src="{{ asset('assets/dashboard/js/index.js') }}"></script>
	</body>
</html>
	